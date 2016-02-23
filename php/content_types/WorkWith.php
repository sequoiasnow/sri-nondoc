<?php

class WorkWith extends ContentType {
    /// The table name specified for this content type
    const TableName = 'work_with';

    /**
     * Return all the fields relevant to the form.
     *
     * @return [field]
     */
    public static function getFields() {
        return array(
            new TextField( array(
                'name'   => 'name',
                'public' => array(
                    'title'       => 'Title',
                    'description' => 'The name of the link that the
                                      element will describe',
                ),
            ) ),
            new TextField( array(
                'name'   => 'blurb',
                'public' => array(
                    'title'       => 'Blurb',
                    'description' => 'Short blurb that can be displayed about
                                      the nature of the link',
                ),
            ) ),
            new TextField( array(
                'name'   => 'image',
                'public' => array(
                    'title' => 'Image',
                    'description' => 'The image to be dispalyed on the front.',
                ),
            ) ),
            new TextField( array(
                'name' => 'link',
                'public' => array(
                    'title' => 'Link',
                    'description' => 'The actual link clicking the element will
                                      result in.',
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
            'name'   => 'title',
            'blurb'  => 'blurb',
            'image'  => 'image',
            'link'   => 'link',
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
        return 'Work With';
    }

    /// Variables in a coordance to the database values.
    public $id;
    public $title;
    public $blurb;
    public $image;
    public $link;

    /**
     * The name of an instance of the NavigationLink class.
     *
     * @return string
     */
    public function getTitle() {
        return $this->title;
    }
}
