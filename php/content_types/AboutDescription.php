<?php
/**
 * Implements the ContentType abstract class and is used to store navigation
 * links in the database using the navigation_links table.
 *
 * @see init/mysql/NavigationLink.mysql
 */
class AboutDescription extends ContentType {
    /// The table name specified for this content type
    const TableName = 'about_description';

    /**
     * Return all the fields relevant to the form.
     *
     * @return [field]
     */
    public static function getFields() {
        return array(
            new TextField( array(
                'name'   => 'title',
                'public' => array(
                    'title'       => 'Title of Element',
                    'description' => 'The title of the element that will
                                      be presented on the about page',
                ),
            ) ),
            new TextField( array(
                'name'   => 'description',
                'public' => array(
                    'title' => 'Description',
                    'description' => 'General description of the element and
                                      what its purpose it',
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
            'title'        => 'title',
            'description'  => 'description',
        );
    }

    /**
     * Returns a description of the given form.
     *
     * @return string
     */
    public static function getDescription() {
        return 'The about description element will be displayed as a component of the
                about page and provides the name and descrpition of part of ARSLS.';
    }

    /**
     * Retrurns a human readable name for the form.
     *
     * @return string
     */
    public static function getName() {
        return 'About Description';
    }

    /// Variables in a coordance to the database values.
    public $id;
    public $title;
    public $href;

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

        return "<div class=\"about-description\"
            <a href=\"{$this->href}\">{$this->title}</a>
        </div>";
    }
}
