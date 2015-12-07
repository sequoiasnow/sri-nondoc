<?php

abstract class ContentType implements FormPrintable {
    /**
     * Return all instances of a content type from the database.
     *
     * @see self::TableName
     *
     * @return [self]
     */
    public static function getAllInstances() {
        $tableName = self::TableName;

        // Query the database for the result.
        $result = Database::query( "SELECT * FROM $tableName" );

        // Loop through the result transforming each value into a class.
        $return = array();
        while ( $row = $result->fetch_assoc() ) {
            $return[] = new self( $row );
        }
        $result->close();

        return $return;
    }

    /// Stores all data, key value pairing exact as in a database.
    private $data;

    /**
     * Default constructor that allowes the use of variables to be
     * incuded in the element.
     *
     * @param array $data
     */
    public function __construct( $data ) {
        foreach ( $data as $key => $val ) {
            $data->$key = $val;
        }

        $this->data = $data;
    }

    /**
     * Allowes the accessing all of the arguments.
     *
     * @return array
     */
    public function getData() {
        return $this->data;
    }
}


include 'NavigationLink.php';
include 'User.php';
