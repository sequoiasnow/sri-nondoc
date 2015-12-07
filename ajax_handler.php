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
if ( ! isset( $data['get'] ) || ! isset( $data['content_type'] ) ) {
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
$requestType = $data['get'];
$contentType = $data['content_type'];
$returnType  = isset( $data['return_type'] ) ? $data['returnType'] : 'rendered';
$id          = isset( $data['id'] ) ? $data['id'] : '';

if ( $requestType == 'form' ) {
    // Access the form and return its value.
    echo '' . Form::createForm( $contentType );
}

if ( $requestType == 'content' ) {

    if ( ! defined( "$contentType::TableName" ) ) { exit(); }


    list( $type, $id ) = Database::escapeString( $contentType::TableName, $id );

    // Construct the where clause.
    $where =  $id ? "WHERE id=$id" : '';

    // Get the needed content.
    $result = Database::query( "SELECT * FROM $type $where" );

    if ( $result->num_rows ) {
        $object = new $type( $result->fetch_assoc() );

        // Determine the necesary return type.
        if ( $returnType == 'renderd' ) {
            echo $object;
        } else if ( $returnType == 'object' ) {
            echo json_encode( $object );
        }
    }
}
