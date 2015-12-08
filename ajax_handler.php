<?php
require_once 'definitions.php';
/**
 * This file is used in coordination with javascript loading from the page.
 *
 * It is designed to allow access to any number of objects called from the site.
 * This makes it possible to load all site content asynchronously.
 *
 * All javascript requests are sent using POST requests for security.
 */
$data = $_POST;

// Ensure all necessary data exists.
if ( ! isset( $data['action'] ) ! isset( $data['request'] ) || ! isset( $data['content_type'] ) ) {
    echo json_encode( array(
        'error' => 'All fields not filled out.'
    ) );
    exit();
}

// Ensure that a user is logged in for the accessal of data.
if ( ! User::getSessionUser() ) {
    echo json_encode( array(
        'error' => 'You lack the necessary credentials.'
    ) );
    exit();
}

/**
 * Check what type of request is being brought.
 *
 * Available request types are:
 *   * form -- get the form from a content_type (string).
 *   * content -- get the content from a content type
 *   *   * Can be used in conjuncton with a 'id' statement to get specific id.
 *   *   * Are to return types, object, and rednered, rendered assumed.
 */
$action      = $data['action'];
$requestType = $data['request'];
$contentType = $data['content_type'];
$returnType  = isset( $data['return_type'] ) ? $data['returnType'] : 'rendered';
$id          = isset( $data['id'] ) ? $data['id'] : '';

if ( $requestType == 'form' && $action == 'get' ) {
    // Access the form and return its value.
    echo '' . Form::createForm( $contentType );
}

if ( $requestType == 'content' && $action == 'get' ) {

    if ( ! defined( "$contentType::TableName" ) ) { exit(); }

    list( $type, $id ) = Database::escapeString( $contentType::TableName, $id );

    // Construct the where clause.
    $where =  $id ? "WHERE id=$id" : '';

    // Get the needed content.
    $result = Database::query( "SELECT * FROM $type $where" );
    $objects = array();

    // Transform the objects into an associative array.
    while ( $row = $result->fetch_assoc() ) {

        $objects[] = new $type( $row );

    }

    // Determine the necesary return type.
    if ( $returnType == 'renderd' ) {
        // Render each object calling the __toString method
        foreach  ( $objects as $object ) {
            echo $object;
        }
    } else if ( $returnType == 'object' ) {
        // Print the result of a json encoded array of object data.
        echo json_encode( $object );
    }

}


/**
 * There is a scenario where the update would need to be perforemd to allow
 * for the deleteion of an element. In this case the element's id must be
 * passed and the keyword delete used. To update an item should typically
 * require a form and has not yet been implemented here.
 */
if ( $requestType == 'delete' && $action == 'set' && $id ) {
    // Perform the initial recieving of the table name
    if ( ! defined( "$contentType::TableName" ) ) { exit(); }

    // Screen id and table name for malicious code.
    list( $type, $id ) = Database::escapeString( $contentType::TableName, $id );

    // Perform update on a specific element with id.
    Database::query( "DELETE FROM $type WHERE id=$id" );
}
