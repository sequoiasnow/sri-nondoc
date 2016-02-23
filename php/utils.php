<?php
/**
 * Perform all contact us logic. Passed to this as a parameter are all elements
 * of the contact us form. This form uses this data, the validation has been
 * passed, to send an email indicating the values of the data.
 *
 * @param array $data
 */
function contactUs( $data ) {
    // Get the info as specified in the contact info section of the site
    // management porition
    $info = ContactInfo::getInstance();

    // For development purposes, currently return;

    // Send an email to the contacted persons
}

/**
 * Escapes a given string for html special chars. Preserves tags.
 *
 * @link http://stackoverflow.com/questions/1364933/htmlentities-in-php-but-preserving-html-tags
 *
 * @param string $htmlText
 * @param int $ent
 *
 * @return string
 */
function __($htmlText, $ent = 0) {
    if ( ! $ent ) $ent = ENT_COMPAT | ENT_HTML401;

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

/**
 * Allows the inclusion of a component template file for easier convenciance
 * of use.
 */
function loadComponetTempalte( $name ) {
    include ROOT_DIR . "/tmpl/components/{$name}.php";
}
