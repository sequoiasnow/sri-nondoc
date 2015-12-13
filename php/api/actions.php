<?php
/**
 * Defines how actions are handled, typically these are the result of forms
 * and are recieved by the actions/.... file.
 *
 * However, in some cassses an action can take a function as an argument, this
 * function would then be called by the form on completion.
 *
 * Note!!! this feature is not yet fully supported.
 */
define( 'ACTION_HANDLER_FILE', WEB_ROOT . '/action_handler.php' );

class Action {
    /// The determining file for redirecting from the prefered action.
    const HandlerFile = ACTION_HANDLER_FILE;

    /**
     * Calls a function from a loaded class, and thus assumes includes all the
     * necessary files.
     *
     * @param array $func
     */
    public static function callActionFunc( array $func ) {
        // Get all the post data for this form...
        $post = $_POST;

        // Print out the result as json for future ajax calls use.
        echo json_encode( call_user_func( $func, $post ) );
    }

    /// Identifies what function will be called from this respective form.
    private $identifier;

    /**
     * Sets the identifier to a uniq id given by the current timestamp
     */
    private function setIdentifier() {
        $this->identifier = hash( 'sha256', uniqid( 'action' ) );
    }

    /**
     * Creates a new instance of the action class with parameters as to what
     * functions should be called.
     *
     * @param array $func
     */
    public function __construct( array $func ) {
        // Generate the identifier.
        $this->setIdentifier();

        // Store the session variable for this identifier.
        $_SESSION["action_{$this->identifier}"] = $func;
    }

    /**
     * Returns the url expected in a form, this often includes a get request,
     * to deterine the actual file reroute.
     *
     * @return string
     */
    public function __toString() {
        return self::HandlerFile . '?action=' . $this->identifier;
    }

}
