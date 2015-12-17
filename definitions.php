<?php
session_start();
// The path to the root directory.
define( 'ROOT_DIR', __DIR__ );

// Load the config file for the site.
require_once ROOT_DIR . '/config.php';

// Define where a user can log in to the page.
define( 'USER_LOGIN', WEB_ROOT . '/login' );

// Allow requests to be made to the database...
require_once ROOT_DIR . '/php/database/database.php';

// Allow the use of actions in form.
require_once ROOT_DIR . '/php/api/api.php';

// Allow the use of forms.
require_once ROOT_DIR . '/php/form/form.php';

// Allowes the implementation of the api
require_once ROOT_DIR . '/php/api/api.php';

// Include information about the data types.
require_once ROOT_DIR . '/php/content_types/ContentType.php';
