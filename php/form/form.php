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

        // All erros to be returned.
        $invalids = array();
        $emptys   = array();

        foreach ( $fullFields as $field ) {
            // Check if the field is empty.
            if ( ! isset( $data[$field->name] ) ) {
                $emptys[] = $field->name;
                continue;
            }

            // Check if the field is valid
            $validation = $field->validate;
            if ( ! $validation( $data[$field->name], $data ) ) {
                $invalids[] = $field->name;
            }
        }

        if ( count( $invalids ) || count( $emptys ) ) {
            return array(
                'invalids' => $invalids,
                'emptys'   => $emptys,
            );
        } else {
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

        // Create the action for the form submission.
        $action = new Action( array( __CLASS__, 'handleContentTypeForm' ) );

        // Return the newly created form class...
        return new self( array(
            'name'        => $name,
            'fields'      => $fields,
            'description' => $desc,
            'action'      => $action,
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
     */
    public function __construct( $args, $addTitle = true ) {
        foreach ( $args as $key => $val ) {
            $this->$key = $val;
        }

        // Alter the fields
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

        $html .= '</form>';
        return $html;
    }
}
