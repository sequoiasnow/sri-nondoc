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
     * @return [static]
     */
    public static function getFromQuery( $query ) {
        // Query the database for the result.
        $result = Database::query( $query );

        // Loop through the result transforming each value into a class.
        $return = array();
        while ( $row = $result->fetch_assoc() ) {
            $return[] = new static( $row );
        }
        $result->close();

        return $return;
    }

    /**
     * Return all instances of a content type from the database.
     *
     * @see static::TableName
     *
     * @return [static]
     */
    public static function getAllInstances() {
        $tableName = static::TableName;
        return static::getFromQuery( "SELECT * FROM $tableName" );
    }

    /**
     * Returns a single instance of the content type, this assumes that only
     * one such content typi is present. The order, therefore, is of no
     * consequence.
     *
     * @see static::TableName
     *
     * @return static
     */
    public static function getInstance() {
        return static::getAllInstances()[0];
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
                $data[$key] = Database::escapeString( $val );
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

    /**
     * A basic toString method that can be overriden.
     *
     * @return string
     */
    public function __toString() {
        return $this->getTitle();
    }
}


include 'NavigationLink.php';
include 'User.php';
include 'AboutDescription.php';
include 'AboutPerson.php';
include 'AboutProcess.php';
include 'LocationSite.php';
include 'NetworkSite.php';
include 'NetworkData.php';
include 'OutreachElement.php';
include 'PageDescription.php';
include 'PageInformation.php';
include 'ProductGroup.php';
include 'TechnologyElement.php';
