<?php
/**
 * Implements the ContentType abstract class and is used to store navigation
 * links in the database using the navigation_links table.
 *
 * @see init/mysql/NavigationLink.mysql
 */
class NavigationLink extends ContentType {
    /// The table name specified for this content type
    const TableName = 'navigation_links';

    /**
     * Return all the fields relevant to the form.
     *
     * @return [field]
     */
    public static function getFields() {
        return array(
            new TextField( array(
                'name'   => 'link_name',
                'public' => array(
                    'title'       => 'Link Title',
                    'description' => 'The title of the link, this will be shown
                                      in the navigation bar.',
                ),
            ) ),
            new TextField( array(
                'name'   => 'href',
                'public' => array(
                    'title' => 'Link',
                    'description' => 'The url, for the link to redirect to. If
                                      the url is for this site, write without
                                      the domain. For example, if the page going
                                      to is test, simply write test. If the
                                      site is on another domain, include
                                      \'http://\'.',
                ),
            ) ),
        );
    }

    /**
     * Returns a description of the given form.
     *
     * @return string
     */
    public static function getDescription() {
        return 'The navigation link will be displayed as a component of the
                sites navigation and allowes the linking of multiple pages.';
    }

    /**
     * Retrurns a human readable name for the form.
     *
     * @return string
     */
    public static function getName() {
        return 'Navigation Link';
    }

    /**
     * Returns the action to be taken, as a string.
     *
     * @return Action
     */
    public static function getAction() {
        return new Action( array(  __CLASS__, 'handleFormSubmit' ) );
    }

    /**
     * Handles the submital of a form. What is returned is given here to be
     * acted upon as the form is validated. Typically the response is governed
     * by ajax, thus, while header function will work, it is preffered to return
     * and array which will dictate the manner of response.
     *
     * @param array $data
     *
     * @return array
     */
    public static function handleFormSubmit( array $data ) {
        // For demo purposes, not production.
        return array(
            'redirect_to' => 'www.apple.com',
        );
    }


    /// Variables in a coordance to the database values.
    public $id;
    public $title;
    public $href;

    /**
     * Construct the class with new data from the database.
     * ( Note this can also be provided by the )
     *
     * @param array $data
     */
    public function __construct( array $data ) {
        // Assign individaul results based off of values in array.
        foreach ( $data as $k => $v ) {
            $this->$k = $v;
        }
    }

    /**
     * Print a navigation link in a cohesive fashion.
     *
     * @return string
     */
    public function __toString() {
        // Transform the title to be html outputable.
        $title = htmlentities($this->title );

        return "<div class=\"navigation-link\"
            <a href=\"{$this->href}\">{$title}</a>
        </div>";
    }
}
