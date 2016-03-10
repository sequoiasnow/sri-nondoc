<?php

class ContactInfo extends ContentType {
    /// The table name specified for this content type
    const TableName = 'contact_info';

    /**
     * Return all the fields relevant to the form.
     *
     * @return [field]
     */
    public static function getFields() {
        return array(
            new TextField( array(
                'name'   => 'email',
                'public' => array(
                    'title'       => 'Email',
                    'description' => 'Email that should be used to access the
                                      site with questions, such, etc...',
                ),
            ) ),
            new TextField( array(
                'name'   => 'phone',
                'public' => array(
                    'title' => 'Phone',
                    'description' => 'A phone number to be reached at.',
                ),
            ) ),
            new TextField( array(
                'name'   => 'location',
                'public' => array(
                    'title'       => 'Location',
                    'description' => 'Where to recieve physical messages, and
                                      people alike.',
                ),
            ) ),
        );
    }

    /**
     * Returns a default map of the fields for the accessal of ajax data.
     * This allowes the form to be populated with data from this instance.
     *
     * @return array.
     */
    public static function getFormFieldMap() {
        return array(
            'email'    => 'email',
            'location' => 'location',
            'phone'    => 'phone',
        );
    }

    /**
     * Returns a description of the given form.
     *
     * @return string
     */
    public static function getDescription() {
        return '';
    }

    /**
     * Retrurns a human readable name for the form.
     *
     * @return string
     */
    public static function getName() {
        return 'Contact Info';
    }

    /// Variables in a coordance to the database values.
    public $id;
    public $toEmail;
    public $fromEmail;
    public $subject;

    /**
     * The name of an instance of the NavigationLink class.
     *
     * @return string
     */
    public function getTitle() {
        return 'General Info';
    }

    /**
     * Print a navigation link in a cohesive fashion.
     *
     * @return string
     */
    public function __toString() {
        return '';
    }
}
