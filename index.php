<?php
require_once 'definitions.php';

// Define the current page path.
define( 'PATH', isset( $_GET['path'] ) ? $_GET['path'] : '' );

// Loads the apropriate page.
if ( file_exists( ROOT_DIR . '/tmpl/pages/' . PATH . '.php' ) ) {
    include ROOT_DIR . '/tmpl/pages/' . PATH . '.php';
} else {
    // Include this file as deault.
    include ROOT_DIR .'/tmpl/pages/default.php';
}
