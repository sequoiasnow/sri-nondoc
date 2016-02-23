<?php

/**
 * Implements the ContentType abstract class and is used to store Locations
 * in the database using the Locations table.
 *
 * @see init/mysql/Locations.mysql
 */
class Locations extends ContentType {
    /// The table name specified for this content type
    const TableName = 'locations';

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
                    'description' => 'The name of the Location.',
                ),
            ) ),
            new TextField( array(
                'name'   => 'blurb',
                'public' => array(
                    'title'       => 'Blurb',
                    'description' => 'Short blurb that can be displayed about
                                      the nature of the locations, not required.',
                ),
                'required' => 'false',
            ) ),
            new TextField( array(
                'name' => 'link',
                'public' => array(
                    'title' => 'Link',
                    'description' => 'The link to the location.',
                ),
            ) ),
            new TextField( array(
                'name'   => 'longitude',
                'public' => array(
                    'title'       => 'Lognitude',
                    'description' => 'The longitudinal coordinates of the
                                      site.',
                ),
            ) ),
            new TextField( array(
                'name'   => 'latitude',
                'public' => array(
                    'title' => 'Latitude',
                    'description' => 'The latitudanal coordinates of the
                                      site.',
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
            'name'      => 'name',
            'blurb'     => 'blurb',
            'link'      => 'link',
            'latitude'  => 'latitude',
            'longitude' => 'longitude',
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
        return 'Locations';
    }

    /// Variables in a coordance to the database values.
    public $id;
    public $title;
    public $blurb;
    public $link;
    public $longitude;
    public $latitude;

    /**
     * The name of an instance of the NavigationLink class.
     *
     * @return string
     */
    public function getTitle() {
        return $this->name;
    }
}
