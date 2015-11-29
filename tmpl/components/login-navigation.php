<?php
/**
 * @package AtomicAppointment
 *
 * Creates the navigation for the login page, this includes links to such
 * pages as about, user log in and help.
 *
 * This should be included after the login portion has been established, as the
 *
 */
?>

<div id="login-navigation" class="side-navigation">
    <article class="navigation-item" id="login">

        <?php if ( PATH == 'user-login' ) : ?>

            <div class="title">
                <a href="login">Client Login</a>
            </div>

        <?php else : ?>

            <div class="title">
                <a href="user-login">User Login</a>
            </div>

        <?php endif; ?>


    </article>

    <article class="navigation-item" id="about">

        <div class="title">
            <a href="about">About</a>
        </div>

    </article>

    <article class="navigation-item" id="help">

        <div class="title">
            <a href="help">?</a>
        </div>

    </article>
</div>
