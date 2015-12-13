<?php
require_once __DIR__ . '/../definitions.php';
// Ensure that a user is logged in for the accessal of data.
if ( ! User::getSessionUser() ) {
    echo "You need to log in... Foo!";
    exit();
}

echo new Api( $_GET['path'] );
