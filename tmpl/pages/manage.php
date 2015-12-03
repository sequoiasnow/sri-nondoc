<?php
/**
 * @package AtomicAppointment
 *
 * The administrative interface for the atomic appointment.
 *
 * Includes links to all aspects of the interface.
 */

// Include manage.js
loadJSFile( 'manage' );

// Allow for the proper css styles to apply.
$bodyClasses = array( 'manage' );

// Determine all the classes that will be used as form types.
$contentTypes = array();
foreach ( get_declared_classes() as $class ) {
    if ( is_subclass_of( $class, 'ContentType' ) ) {
        $contentTypes[] = $class;
    }
}

include __DIR__ . '/../.components/header.php'; ?>

    <div id="page">

        <div id="navigation">

            <div id="user-info"><?php print $user->name; ?></div>

            <div id="user-logout">Logout</div>

        </div>

        <div id="content">
            <div id="content-container">
            </div>
        </div>

        <div id="content-types">
            <?php /* Load the content types from the array of their values */ ?>
            <?php foreach ( $contentTypes as $type ) : ?>

                <div class="content-type">
                    <span><?php print $type::getName(); ?></span>
                </div>

            <?php endforeach; ?>
        </div> <!-- #content-types -->

    </div> <!-- #page -->

<?php include __DIR__ . '/../.components/footer.php'; ?>
