<?php
// Get some config files.
require_once __DIR__ . '/../config.php';

// Execute the building of the mysql through exec
echo shell_exec( 'mysql -u ' . DB_USER . ' -p\'' . DB_PASS . '\' ' . DB_NAME . ' < ' . __DIR__ . '/init.mysql' );
