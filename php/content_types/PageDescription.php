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
                    'title'       => 'Product Group',
                    'description' => 'The name of the page that the
                                      element will describe and be displayed on',
                ),
            ) ),
            new TextField( array(
                'name'   => 'blurb',
                'public' => array(
                    'title' => 'Small Blurb of Group',
                    'description' => 'Short blurb about the page that can be
                                      displayed on another page',
                ),
            ) ),
            new TextField( array(
                'name'   => 'description',
                'public' => array(
                    'title' => 'Description',
                    'description' => 'General description of the page
                                      and other relevant details',
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
            'name'              => 'title',
            'blurb'             => 'blurb',
            'description'       => 'description'
        );
    }

    /**
     * Returns a description of the given form.
     *
     * @return string
     */
    public static function getDescription() {
        return 'The page description will be displayed with the blurb on the
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

    /// Variables in a coordance to the database values.
    public $id;
    public $title;
    public $blurb;
    public $description;

    /**
     * The name of an instance of the NavigationLink class.
     *
     * @return string
     */
    public function getTitle() {
        return $this->title;
    }

    /**
     * Print a navigation link in a cohesive fashion.
     *
     * @return string
     */
    public function __toString() {
        // Transform the title to be html outputable.
        $title = htmlentities($this->title );

        return "<div class=\"location-site\"
            <a href=\"{$this->href}\">{$this->title}</a>
        </div>";
    }
}
