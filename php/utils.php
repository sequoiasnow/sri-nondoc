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
}
