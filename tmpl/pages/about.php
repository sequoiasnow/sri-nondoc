<?php
/**
 * Loggs in a user with a form for the institution of creating a user.
 */
$bodyClasses = array( 'about' );

include __DIR__ . '/../components/header.php'; ?>

    <nav>
        <?php
        $navLinks = NavigationLink::getAll();

        foreach ( $navLinks as $link ) {
            print $link;
        }
        ?>

    </nav>

<?php include __DIR__ . '/../components/footer.php'; ?>
