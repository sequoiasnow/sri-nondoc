<?php
include 'definitions.php';

// Loggs of a user.
unset( $_SESSION['user_id'] );
unset( $_SESSION['user_pass'] );

header( 'Location: ' . WEB_ROOT . '/login' );
