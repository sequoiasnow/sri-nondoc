<?php
require_once 'definitions.php';

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
