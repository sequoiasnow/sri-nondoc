<?php
require_once __DIR__ . '/../definitions.php';

// Create all the tables for the mysql classes.
$contentTypes = array();
foreach ( get_declared_classes() as $class ) {
    if ( is_subclass_of( $class, 'ContentType' ) ) {
        $contentTypes[] = $class;
    }
}

/// Checks if a table exists.
function tableExists( $name ) {
    $result = Database::query( "SHOW TABLES LIKE '$name'" );

    if ( $result ) {
        $ret = $result->num_rows == 1;
        $result->close();
        return $ret;
    }
    return false;
}

// Loop through the content types.
foreach ( $contentTypes as $type ) {

    if ( defined( "$type::TableName" ) ) {
        $tableName = $type::TableName;

        // Check if a file exists with that.
        if ( file_exists( __DIR__ . "/mysql/{$type}.mysql" ) && ! tableExists( $tableName ) ) {
            echo "Creating table for {$type}\n\n";

            // Execute the building of the mysql through exec
            echo shell_exec( 'mysql -u ' . DB_USER . ' -p\'' . DB_PASS . '\' ' . DB_NAME . ' < ' . __DIR__ . '/mysql/' . $type . '.mysql' );
        }
    }
}
