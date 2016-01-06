<?php
/**
 * Implements the ContentType abstract class and is used to store navigation
 * links in the database using the navigation_links table.
 *
 * @see init/mysql/NavigationLink.mysql
 */
class PageInformation extends ContentType {
    /// The table name specified for this content type
    const TableName = 'page_information';

    /**
     * Return all the fields relevant to the form.
     *
     * @return [field]
     */
    public static function getFields() {
        return array(
            new TextField( array(
                'name'   => 'url',
                'public' => array(
                    'title'       => 'Page Url',
                    'description' => 'The url of the page, this is the part
                    that follows the domain, no proceeding slash. If this is
                    the splashpage simply put index.php.',
                ),
            ) ),
            new TextField( array(
                'name'   => 'title',
                'public' => array(
                    'title'       => 'Page Title',
                    'description' => 'The title of the page, displayed in the
                                      window\'s tab',
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
            'title' => 'title',
            'url'   => 'url',
        );
    }

    /**
     * Returns a description of the given form.
     *
     * @return string
     */
    public static function getDescription() {
        return 'Page information gives basic information about pages, typically
                this is static info and should not need much updating.';
    }

    /**
     * Retrurns a human readable name for the form.
     *
     * @return string
     */
    public static function getName() {
        return 'Page Information';
    }

    /**
     * Returns the correct page information object from the path, checks where
     * the path matches the url. If no match is found assume index.php.
     *
     * @param string $path
     *
     * @return self
     */
    public static function getFromPath( $path ) {
        // Establish some info for the query.
        $path      = Database::escapeString( $path );
        $tableName = self::TableName;

        $res = Database::query( "SELECT * FROM $tableName WHERE url='$path'" );
        if ( $res->num_rows ) {
            $info = $res->fetch_assoc();
            $res->close();
            return new self( $info );
        } else if ( $path == 'index.php' ) {
            // Prevent infinite recursion
            return null;
        }

        // Perform default search.
        return self::getFromPath( 'index.php' );
    }

    /// Variables in a coordance to the database values.
    public $id;
    public $url;
    public $title;

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

        return $title;
    }
}
