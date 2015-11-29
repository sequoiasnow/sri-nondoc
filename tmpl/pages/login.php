<?php
/**
 * @package AtomicAppointment
 *
 * Created for the purpose of login in a user.
 *
 * This can include loging in a user or a client with a hash.
 *
 * By default a hash is assumed.
 */

// Determine the body classes that are relevant to the current project.
$bodyClasses = array( 'login', 'client-login' );

// Add a title for the body
$pageTitle = 'Atomic Appointment Login';

// Create a new form that will be used to handle the login.
$loginForm = new Form( array(
    'action' => 'login',
    'fields' => array(
        array(
            'container'        => array( 'id' => 'hash-login-field' ),
            'type'             => 'text',
            'name'             => 'client_key',
            'spellcheck'       => 'false',
            'placeholder'      => 'Your Unique Identifier Here',
            'submit-on-return' => 'true',
        ),
    ),
) );

// Include before as specifies loadJSFile.
include __DIR__ . '/../components/header.php';
?>
    <div class="center-login">

        <article id="login-container" class="panel">
            <header>

                <?php include __DIR__ . '/../components/logo.php'; ?>

                <h1 class="title">Atomic Appointment</h1>

            </header>

            <?php echo $loginForm; ?>


            <?php include __DIR__ . '/../components/login-navigation.php'; ?>

        </article>

    </div>


<?php include __DIR__ . '/../components/footer.php'; ?>
