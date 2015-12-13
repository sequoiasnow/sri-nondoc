<?php
session_start();
// The path to the root directory.
define( 'ROOT_DIR', __DIR__ );

// Define the web root for the system.
define( 'WEB_ROOT', 'http://localhost/~sequoiasnow/work/sri-nondoc' );

// Define where a user can log in to the page.
define( 'USER_LOGIN', WEB_ROOT . '/login' );

// Load the config file for the site.
require_once ROOT_DIR . '/config.php';

// Allow requests to be made to the database...
require_once ROOT_DIR . '/php/database/database.php';

// Allow the use of actions in form.
require_once ROOT_DIR . '/php/api/api.php';

// Allow the use of forms.
require_once ROOT_DIR . '/php/form/form.php';

// Include information about the data types.
require_once ROOT_DIR . '/php/content_types/ContentType.php';
