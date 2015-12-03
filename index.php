<?php
require_once 'definitions.php';

// Define the current page path.
define( 'PATH', isset( $_GET['path'] ) ? $_GET['path'] : '' );

// Check if is an administrative page...
$user = null;
if ( strpos( PATH, 'manage' ) === 0 ) {
    // Check if a user is logged in...
    if ( isset( $_SESSION['user_id'] ) && isset( $_SESSION['user_pass'] ) ) {
        $id   = Database::escapeString( $_SESSION['user_id'] );
        $pass = Database::escapeString( $_SESSION['user_pass'] );
        $result = Database::query( "SELECT *
                                    FROM users
                                    WHERE id='$id'
                                      AND pass='$pass'" );
        // Check if a result was returned...
        if ( $result->num_rows ) {
            /// Create the user...
            $user = new User( $result->fetch_assoc() );
        }
        $result->close();
    }

    // If there is no user, send them to login.
    if ( ! $user ) {
        header( 'Location: ' . USER_LOGIN );
    }
}

// Loads the apropriate page.
if ( file_exists( ROOT_DIR . '/tmpl/pages/' . PATH . '.php' ) ) {
    include ROOT_DIR . '/tmpl/pages/' . PATH . '.php';
} else {
    // Include this file as deault.
    include ROOT_DIR .'/tmpl/pages/index.php';
}
