<?php
require_once 'form_printable.php';
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
        $action = $action ? $action : $class::getAction();

        // Return the newly created form class...
        return new self( array(
            'name' => $name,
        ) );
    }
}
