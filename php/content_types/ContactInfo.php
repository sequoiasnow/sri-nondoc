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
                'name'   => 'to_email',
                'public' => array(
                    'title'       => 'To Email',
                    'description' => 'Email that should be notfied when a
                                      comemnt is posted.',
                ),
            ) ),
            new TextField( array(
                'name'   => 'from_email',
                'public' => array(
                    'title' => 'From Email',
                    'description' => 'The email which should show as having sent
                                      the message for the comemnt. (Note this
                                      field may not be the actual email used
                                      to send the message).',
                ),
            ) ),
            new TextField( array(
                'name'   => 'from_subject',
                'public' => array(
                    'title'       => 'From Subject',
                    'description' => 'The subject line you will recieve when a
                                       new comment is posted from the site.',
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
            'to_email'     => 'toEmail',
            'from_email'   => 'fromEmail',
            'from_subject' => 'subject',
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
