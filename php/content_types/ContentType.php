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
}


include 'NavigationLink.php';
include 'User.php';
