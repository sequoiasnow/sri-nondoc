<?php
require_once __DIR__ . '/../definitions.php';

echo shell_exec( 'mysql -u ' . DB_USER . ' -p\'' . DB_PASS . '\' ' . DB_NAME . ' < ' . __DIR__ . '/alterations.mysql' );
