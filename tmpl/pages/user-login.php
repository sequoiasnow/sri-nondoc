<?php
/**
 * @package AtomicAppointment
 *
 * Created for the purpose of login in a user.
 *
 * Can also sign up a user.
 *
 * By default a hash is assumed.
 */

// Check if should redirect to manage by default.
if ( defined( 'IS_ADMIN' ) ) {
    header( 'Location: ' . WEB_ROOT . '/manage' );
    exit();
}

// Determine the body classes that are relevant to the current project.
$bodyClasses = array( 'login', 'user-login' );

// Add a title for the body
$pageTitle = 'Atomic Appointment Login';

// Create a new form that will be used to handle the login.
$loginForm = new Form( array(
    'action'     => 'user_login',
    'attributes' => array( 'id' => 'form-login' ),
    'fields'     => array(
        array(
            'type'        => 'email',
            'name'        => 'email',
            'spellcheck'  => 'false',
            'placeholder' => 'youremail@fakedomain.com',
        ),
        array(
            'type'             => 'password',
            'name'             => 'password',
            'placeholder'      => 'password',
            'submit-on-return' => 'true',
        ),
        array(
            'type'  => 'submit',
            'name'  => 'submit',
            'value' => 'Login',
        ),
    ),
) );

// A form that will be used to handle the signing up of a user.
$signUpForm = new Form( array(
    'action'     => 'user_signup',
    'attributes' => array( 'id' => 'form-signup' ),
    'fields'     => array(
        array(
            'type'        => 'email',
            'name'        => 'email',
            'spellcheck'  => 'false',
            'placeholder' => 'youremail@fakedomain.com',
        ),
        array(
            'container'   => array( 'id' => 'name-signin-field' ),
            'type'        => 'text',
            'name'        => 'name',
            'icon'        => 'user',
            'placeholder' => 'Your Name',
        ),
        array(
            'type'        => 'password',
            'name'        => 'password-1',
            'placeholder' => 'password',
        ),
        array(
            'type'        => 'password',
            'name'        => 'password-2',
            'placeholder' => 'confirm password',
        ),
        array(
            'type'  => 'submit',
            'name'  => 'submit',
            'value' => 'Sign Up!',
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

            <?php
            // Navigation is handeled by javascript
            loadJSFile( 'user-login-form-pick' );
            ?>


            <div id="form-container">

                <?php echo $loginForm; ?>

                <?php echo $signUpForm; ?>

            </div>

            <div id="login-signup-navigation" class="side-navigation">
                <article class="navigation-item" id="login">

                    <div class="title" id="signin-toggle"></div>

                </article>
            </div>

            <?php include __DIR__ . '/../components/login-navigation.php'; ?>

        </article>

    </div> <!-- .center-login -->


<?php include __DIR__ . '/../components/footer.php'; ?>
