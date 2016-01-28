<?php
require_once 'definitions.php';

/**
 * Function that escapes characters.
 *
 * @param string
 *
 * @return string
 */
function __( $htmlText ) {
    $ent = ENT_COMPAT | ENT_HTML401;

    $matches = Array();
    $sep = '###HTMLTAG###';

    preg_match_all(":</{0,1}[a-z]+[^>]*>:i", $htmlText, $matches);

    $tmp = preg_replace(":</{0,1}[a-z]+[^>]*>:i", $sep, $htmlText);
    $tmp = explode($sep, $tmp);

    for ($i=0; $i<count($tmp); $i++)
        $tmp[$i] = htmlentities($tmp[$i], $ent, 'UTF-8', false);

    $tmp = join($sep, $tmp);

    for ($i=0; $i<count($matches[0]); $i++)
        $tmp = preg_replace(":$sep:", $matches[0][$i], $tmp, 1);

    return $tmp;
}

// Define the current page path.
define( 'PATH', isset( $_GET['path'] ) ? $_GET['path'] : '' );

// Check if is an administrative page...
$user = User::getSessionUser();

// Ensure the credentials of the user
if ( strpos( PATH, 'manage' ) === 0 && ! $user ) {
    // If there is no user, send them to login.
    header( 'Location: ' . USER_LOGIN );
}

// Loads the apropriate page.
if ( file_exists( ROOT_DIR . '/tmpl/pages/' . PATH . '.php' ) ) {
    include ROOT_DIR . '/tmpl/pages/' . PATH . '.php';
} else {
    // Include this file as deault.
    include ROOT_DIR .'/tmpl/pages/index.php';
}
