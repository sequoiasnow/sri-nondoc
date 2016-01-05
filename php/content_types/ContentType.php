<?php

abstract class ContentType implements FormPrintable, AjaxRetrievable {
    /**
     * Perform a query from the database and iterates through all the
     * fields to create the reuslt.
     *
     * @see Database::query
     *
     * @param string $query
     *
     * @return [self]
     */
    public static function getFromQuery( $query ) {
        // Query the database for the result.
        $result = Database::query( $query );

        // Loop through the result transforming each value into a class.
        $return = array();
        while ( $row = $result->fetch_assoc() ) {
            $return[] = new self( $row );
        }
        $result->close();

        return $return;
    }

    /**
     * Return all instances of a content type from the database.
     *
     * @see self::TableName
     *
     * @return [self]
     */
    public static function getAllInstances() {
        $tableName = self::TableName;
        return self::getFromQuery( "SELECT * FROM $tableName" );
    }

    /// Stores the title for access by the other properties.
    public $_title;

    /**
     * Default constructor that allowes the use of variables to be
     * incuded in the element.
     *
     * @param array $data
     */
    public function __construct( $data ) {
        foreach ( $data as $key => $val ) {
            $this->$key = $val;
        }

        $this->_title = $this->getTitle();
    }

    /**
     * Allowes the accessing all of the arguments.
     *
     * @return array
     */
    public function getData() {
        $data = array();
        foreach ( $this as $key => $val ) {
            if ( strpos( $key, '_' ) !== 0 ) {
                $data[$key] = $val;
            }
        }
        return $data;
    }

    /**
     * A getter for all data objects.
     *
     * @param string $key
     *
     * @return mixed
     */
    public function getDataVar( $key ) {
        return $this->$key;
    }

    /**
     * A setter for all data objects.
     *
     * @param string $key
     * @param mixed $data
     *
     * @return mixed
     */
    public function setDataVar( $key, $data ) {
        $this->$key = $data;
        return $this->$key;
    }
}


include 'NavigationLink.php';
include 'User.php';
include 'AboutDescription.php';
include 'AboutPerson.php';
include 'LocationSite.php';
include 'NetworkSite.php';
include 'OutreachElement.php';
include 'PageTitle.php';
include 'TechnologyElement.php';
