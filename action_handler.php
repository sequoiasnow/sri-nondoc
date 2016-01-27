<?php
require_once 'definitions.php';

if ( isset( $_GET['action'] ) ) {
    // Determine the correct form to call.
    $action = $_GET['action'];

    // Check the session for the aproprivate function to call.
    if ( isset( $_SESSION["action_{$action}"] ) ) {
        $func = $_SESSION["action_{$action}"];

        // Call the actual action.
        Action::callActionFunc( $func );

        // There is no need to unset sesssion variables as they are
        // automatically destroyed. This allowes a form to be resubmited.
    }
}
