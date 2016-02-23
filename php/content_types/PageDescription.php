<?php
/**
 * Implements the ContentType abstract class and is used to store navigation
 * links in the database using the navigation_links table.
 *
 * @see init/mysql/NavigationLink.mysql
 */
class PageDescription extends ContentType {
    /// The table name specified for this content type
    const TableName = 'page_description';

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
                    'title'       => 'Page Name',
                    'description' => 'The name of the page section. The available
                                      options are: title, about, product-groups
                                      network, work-with, staff, contact',
                ),
                'validation' => function ( $val ) {
                    return in_array( $val, array(
                        'title',
                        'about',
                        'product-groups',
                        'network',
                        'work-with',
                        'staff',
                        'contact',
                    ) );
                },
            ) ),
            new TextField( array(
                'name' => 'title',
                'public' => array(
                    'title'        => 'Title',
                    'description' => 'The physical title shown on this page',
                ),
            ) ),
            new TextField( array(
                'name'     => 'alternate',
                'public'   => array(
                    'title'       => 'Alternate Field',
                    'description' => 'Where to put alternate information, such
                                      as tags or a slogan.',
                ),
            ) ),
            new TextAreaField( array(
                'name'   => 'description',
                'public' => array(
                    'title' => 'Description',
                    'description' => 'General description/introduction of the
                                      page.',
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
            'name'        => 'name',
            'title'       => 'title',
            'alternate'   => 'alternate',
            'description' => 'description',
        );
    }

    /**
     * Returns a description of the given form.
     *
     * @return string
     */
    public static function getDescription() {
        return 'The page description will be displayed on the
                splash page and gives a large description of one of the
                other relevant pages that are part of the site.';
    }

    /**
     * Retrurns a human readable name for the form.
     *
     * @return string
     */
    public static function getName() {
        return 'Page Description';
    }

    /**
     *
     *
     */
    public static function getFromName( $name ) {
        $table = self::TableName;
        $res = self::getFromQuery( "SELECT * FROM $table WHERE name='$name'" );
        return $res[0];
    }

    /// Variables in a coordance to the database values.
    public $id;
    public $name;
    public $title;
    public $alternate;
    public $description;

    /**
     * The name of an instance of the NavigationLink class.
     *
     * @return string
     */
    public function getTitle() {
        return $this->name;
    }
}
