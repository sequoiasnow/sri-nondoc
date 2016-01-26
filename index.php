<?php
require_once 'definitions.php';

/**
 * Function that escapes characters.
 *
 * @param string
 *
 * @return string
 */
function __( $string ) {
    return htmlspecialchars( $string );
}

/**
 * Returns the actual path to the image.
 *
 * @param string $image
 *
 * @return string
 */
function get_image( $image ) {
    if ( strpos( $image, 'http' ) != -1 ) {
        return "files/images/$image";
    }
    return $image;
}

// Define the current page path.
define( 'PATH', isset( $_GET['path'] ) ? $_GET['path'] : '' );

// Check if is an administrative page...
$user = User::getSessionUser();

// Ensure the credentials of the user
if ( strpos( PATH, 'manage' ) === 0 && ! $user ) {
    // If there is no user, send them to login.
    header( 'Location: ' . USER_LOGIN );
}

// Loads the apropriate page.
if ( file_exists( ROOT_DIR . '/tmpl/pages/' . PATH . '.php' ) ) {
    include ROOT_DIR . '/tmpl/pages/' . PATH . '.php';
} else {
    // Include this file as deault.
    include ROOT_DIR .'/tmpl/pages/index.php';
}
