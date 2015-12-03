<?php
require_once 'FormPrintable.php';
require_once 'fields/field.php';

class Form {
    /**
     * Creates a new form instance from a form printable class, pulling the
     * data from it.
     *
     * @param FormPrintable $class
     * @param string $action
     *
     * @return Form
     */
    public static function createForm( $class, $action = '' ) {
        $name   = $class::getName();
        $fields = $class::getFields();
        $desc   = $class::getDescription();
        $action = $action ?: $class::getAction();

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
        }

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
     * Creates a new instance of a form with arguments.
     */
    public function __construct( $args ) {
        foreach ( $args as $key => $val ) {
            $this->$key = $val;
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

        $html .= '</form>';
        return $html;
    }
}
