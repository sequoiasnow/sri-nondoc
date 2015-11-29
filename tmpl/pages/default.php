<?php
/**
 * @package AtomicAppointment
 * The default page loaded by atomic appointment.
 *
 * As at this point authentication may or may not be present it must be tested
 *
 * against to determine if the login page should be displayed or the content
 * page.
 */
if ( defined( 'IS_USER' ) ) {
    // By default go to admin.
    include 'admin.php';
} else if ( defined( 'IS_CLIENT' ) ) {
    // As a confirmed client go select appointemnts.
    include 'appointments.php';
} else {
    // If no user is provided by default send to the login page.
    include 'login.php';
}
