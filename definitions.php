<?php
session_start();
// The path to the root directory.
define( 'ROOT_DIR', __DIR__ );

// Define the web root for the system.
define( 'WEB_ROOT', 'http://localhost/~sequoiasnow/atomic-appointment' );

// Load the config file for the site.
require_once ROOT_DIR . '/config.php';

// Allow requests to be made to the database...
require_once ROOT_DIR . '/php/database/database.php';

// Include information about the data types.
require_once ROOT_DIR . '/php/data_types/datatype.php';

// Allow the use of forms.
require_once ROOT_DIR . '/php/form/form.php';


/**
 * Determine the type of the page that is to be loaded.
 *
 * This is bassed off of user authentication as administrator or otherwise.
 */
$user = null;
$client = null;
if ( isset( $_SESSION['user_email'] ) && isset( $_SESSION['user_pass'] ) ) {
    // Set some basic variables.
    $userEmail = $_SESSION['user_email'];
    $userPass  = $_SESSION['user_pass'];

    // Confirm user password and user name.
    $result = Database::query( "SELECT * FROM users WHERE email = '$userEmail' AND pass = '$userPass'" );

    if ( $result->num_rows ) {
        $user = new User( $result->fetch_assoc() );
    }
    // Close the mysql result.
    $result->close();

    // Confirm the administrator role.
    define( 'IS_ADMIN', true );

} else if ( isset( $_SESSION['client_key'] ) ) {
    // The user is a client.
    $key = $_SESSION['client_key'];

    // Check if the client has a valid key.
    $result = Database::query( "SELECT * FROM clients WHERE hash = '$key'" );

    if ( $result->num_rows ) {
        $client = new Client( $result->fetch_assoc() );
    }

    $result->close();

    // Confirm the client status
    define( 'IS_CLIENT', true );
} else {
    define( 'IS_UNKNOWN', true );
}
