<?php

class Form {
    // Used to store all arguments.
    private $fields = array();
    private $action;
    private $attributes = array();

    /**
     * Construct with an array of parameters.
     */
    public function __construct( $args ) {
        if ( isset( $args['fields'] ) )     $this->fields     = $args['fields'];
        if ( isset( $args['action'] ) )     $this->action     = $args['action'];
        if ( isset( $args['attributes'] ) ) $this->attributes = $args['attributes'];
    }

    /**
     * Conveniance function which returns a string of valid html attributes.
     *
     * @param array $attrs
     *
     * @return string
     */
    private function getAttrString( $attrs ) {
        $attrString = '';

        foreach ( $attrs as $key => $value ) {

            $attrString .= "$key=\"$value\" ";
        }

        return $attrString;
    }

    /**
     * Allow the printing of the form element.
     */
    public function __toString() {
        // Piece together the opening of the form html.
        $action = $this->action ? 'action="actions/' . $this->action . '.php"' : '';
        $result = '<form ' . $action . ' method="post" ' . $this->getAttrString( $this->attributes ). '>';

        foreach ( $this->fields as $field ) {
            // Attributes used for the field.
            $attributes =  array_diff_key( $field , array( 'type' => true, 'container' => true, 'icon' => true ) );
            $attributesString = $this->getAttrString( $attributes );

            // Attributes for the container.
            $containerAttributes = isset( $field['container'] ) ? $field['container'] : array();
            $containerAttributesString = $this->getAttrString( $containerAttributes );

            // Variables that may or may not be used.

            // An icon to display on the form.
            $icon = isset( $field['icon'] ) ? $field['icon'] : false;
            $iconStr = $icon ? "<i class=\"fa fa-$icon\"></i>" : '';

            // Some classes for the container that can be used ror styling.
            $classes    = array( "type-{$field['type']}" );
            if ( $icon ) { $classesArray[] = 'has-icon'; }
            $classesStr = implode( $classes, ' ' );

            // Include the actual file and capture the contents of its evaluation.
            ob_start();
            include "form_elements/{$field['type']}.php";
            $result .= ob_get_contents();
            ob_get_clean();
        }

        // Close the form tag and return it with its contents.
        $result .= '</form>';
        return $result;
    }
}
