<?php
/**
 * @package AtomicAppointment
 *
 * The administrative interface for the atomic appointment.
 *
 * Includes links to all aspects of the interface.
 */

// Allow for the proper css styles to apply.
$bodyClasses = array( 'manage' );

// Show the title of the page.
$pageTitle = 'Manage';

// Determine all the classes that will be used as form types.
$contentTypes = array();
foreach ( get_declared_classes() as $class ) {
    if ( is_subclass_of( $class, 'ContentType' ) ) {
        $contentTypes[] = $class;
    }
}

include __DIR__ . '/../components/header.php';

// Include manage.js
loadJSFile( 'manage' );
?>


    <div id="navigation">

        <div id="user-info"><?php print $user->name; ?></div>

        <div id="user-logout"><a href="logout.php">Logout</a></div>

    </div> <!-- #navigation -->

    <div id="page">

        <div id="content-types">
            <ul>
                <?php /* Load the content types from the array of their values */ ?>
                <?php foreach ( $contentTypes as $type ) : ?>

                    <li class="content-type" data-classname="<?php print $type; ?>">
                        <div class="name">
                            <span><?php print $type::getName(); ?></span>
                        </div>
                        <ul class="instances">
                            <li class="add-new instance"><i class="fa fa-plus"></i></li>
                        </ul>
                    </li>

                <?php endforeach; ?>
            </ul>
        </div> <!-- #content-types -->

        <div id="content">
            <div id="content-container">
            </div>
        </div>

    </div> <!-- #page -->

<?php include __DIR__ . '/../components/footer.php'; ?>
