<?php
require_once 'FormPrintable.php';
require_once 'fields/field.php';

class Form {
    /**
     * Performes validation for form on completion. Also saves the form into
     * the database. Uses the objects form validation and formFieldMap.
     *
     * @param array $data.
     *
     * @return array
     */
    public static function handleContentTypeForm( $data ) {
        if ( ! isset( $data['content_type'] ) ) {
            return array( 'errors' => array( 'no content type' ) );
        }

        // Determine the content type for the existing data.
        $contentType = $data['content_type'];

        // Get the fields for the content type.
        $fullFields = $contentType::getFields();

        // Get the map for the full fields.
        $fieldMap = $contentType::getFormFieldMap();

        // All erros to be returned.
        $invalids = array();
        $emptys   = array();

        // An array which will be used to save data.
        $args     = array();

        foreach ( $fullFields as $field ) {
            // Check if the field is empty.
            if ( ! isset( $data[$field->name] ) ) {
                $emptys[] = $field->name;
                continue;
            }

            // Check if the field is valid
            $validation = $field->validation;
            if ( ! $validation( $data[$field->name], $data ) ) {
                $invalids[] = $field->name;
                continue;
            }
            // Establish the propery name.
            $propName = $fieldMap[$field->name];

            // Check if a function exists for the establishment of the prop.
            if ( method_exists( $contentType, "hookSaveAs__$propName" ) ) {
                $args[$propName] = call_user_func( array(
                    $contentType, "hookSaveAs__$propName"
                ), $data[$field->name] );
            } else {
                // Save the valid data to the field.
                $args[$propName] = $data[$field->name];
            }
        }

        // Include the id in args.
        if ( isset( $data['id'] ) ) {
            $args['id'] = $data['id'];
        }

        if ( count( $invalids ) || count( $emptys ) ) {
            return array(
                'invalids' => $invalids,
                'emptys'   => $emptys,
            );
        } else {
            // Create the object.
            $object = new $contentType( $args );

            // Save the object to the database.
            Database::save( $object );

            // Indicate success of venture.
            return array( 'success' => true );
        }
    }

    /**
     * Creates a new form instance from a form printable class, pulling the
     * data from it.
     *
     * @param FormPrintable $class
     * @param ContentType $object
     *
     * @return Form
     */
    public static function createForm( $class, $object = 0 ) {
        $name   = $class::getName();
        $fields = $class::getFields();
        $desc   = $class::getDescription();

        $nameFieldMap = $class::getFormFieldMap();

        // Loop through the fields to change into objects if need be.
        foreach ( $fields as &$field ) {
            if ( is_array( $field ) ) {
                // Transform the field.
                $type = isset( $field['type'] ) ? $field['type'] : 'text';
                unset( $field['type'] );

                // Class name is concatonation of type and Field.
                $className = "{$type}Field";

                $field = new $className( $field );
            }

            if ( $object ) {
                // Get the field offset from the name.
                $objectField = $nameFieldMap[$field['name']];

                // Go through the values of the field and fill their values.
                if ( $objectField && isset( $object->$objectField ) ) {
                    $field['value'] = $object->$objectField;
                }
            }
        }

        // Add a hidden field for the content type...
        $fields[] = new HiddenField( array(
            'name'  => 'content_type',
            'value' => $class,
        ) );

        // Add a field for the id of the object.
        if ( $object ) {
            $fields[] = new HiddenField( array(
                'name'  => 'id',
                'value' => $object->id,
            ) );
        }

        // Create the action for the form submission.
        $action = new Action( array( __CLASS__, 'handleContentTypeForm' ) );

        // Return the newly created form class...
        return new self( array(
            'name'        => $name,
            'fields'      => $fields,
            'description' => $desc,
            'action'      => $action,
            'desc_cont'   => true,
        ) );
    }

    /// Variables concerning the form.
    protected $name;
    protected $fields;
    protected $decription;
    protected $action;

    /**
     * Gets a string of attributs for the form as provided by the fields.
     *
     * @return string
     */
    protected function attributeStr() {
        $attrs = array(
            'id'     => $this->name,
            'action' => '' . $this->action,
            'method' => 'POST',
        );

        $html = '';

        foreach ( $attrs as $key => $val ) {
            $html .= "$key=\"$val\"";
        }

        return $html;
    }

    /**
     * Creates a new instance of a form with arguments
     *
     * @param array $args
     * @param bool $addSubmit
     */
    public function __construct( $args, $addSubmit = true ) {
        foreach ( $args as $key => $val ) {
            $this->$key = $val;
        }

        // Alter the fields
        if ( $addSubmit ) {
            $this->fields[] = new SubmitField();
        }

        // Load the form javascript if possible.
        if ( function_exists( 'loadJSFile' ) ) {
            loadJSFile( 'form' );
        }
    }

    /**
     * Prints the output as a cohesive string. Full html.
     *
     * @return string.
     */
    public function __toString() {
        $html = "<form {$this->attributeStr()}>";

        foreach ( $this->fields as $field ) {
            $html .= "\n" . $field;
        }

        if ( isset( $this->desc_cont ) && $this->desc_cont ) {
            $html .= '<div class="all-field-description"></div>';
        }

        $html .= '</form>';

        return $html;
    }
}
