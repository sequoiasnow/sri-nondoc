<?php
class User extends ContentType {
    /// The table name specified for this content type
    const TableName = 'users';

    /**
     * Return all the fields relevant to the form.
     *
     * @return [field]
     */
    public static function getFields() {
        return array(
            new TextField( array(
                'name'   => 'user_name',
                'public' => array(
                    'title'       => 'Name',
                    'description' => 'The name of the user, typical fasshion is
                                      First and then Last, but just First is
                                      fine to.',
                ),
                'validation' => function( $value ) {
                    return isset( $value );
                }
            ) ),
            new TextField( array(
                'name'   => 'user_email',
                'public' => array(
                    'title'       => 'Email',
                    'description' => 'The user email, ensure this is a valid
                                      email. This will largelly be used to
                                      reset passwords if need be.',
                ),
                'validation' => function( $value ) {
                    return filter_var( $value, FILTER_VALIDATE_EMAIL );
                }
            ) ),
            new PasswordField( array(
                'name'   => 'user_password_1',
                'public' => array(
                    'title'       => 'Password',
                    'description' => 'A unique password, please use at least
                                      8 characters, the more the better.',
                ),
                'validation' => function( $value, $all ) {
                    return $value == $all['user_password_2'];
                }
            ) ),

            new PasswordField( array(
                'name'   => 'user_password_2',
                'public' => array(
                    'title'       => 'Confirm Password',
                    'description' => '',
                ),
                'validation' => function( $value, $all ) {
                    return $value == $all['user_password_1'];
                }
            ) ),
        );
    }

    /**
     * Returns a default map of the fields for the accessal of ajax data.
     * This allowes the form to be populated with data from this instance.
     *
     * @return array.
     */
    public static function getFormFieldMap() {
        return array(
            'user_name'       => 'name',
            'user_email'      => 'email',
            'user_password_1' => null,
            'user_password_1' => null,
        );
    }

    /**
     * Returns a description of the given form.
     *
     * @return string
     */
    public static function getDescription() {
        return 'Users are never exposed to the public but can contribute and
                alter content on the site. The creation of users should be
                selective as at the moment all users are administrators.';
    }

    /**
     * Retrurns a human readable name for the form.
     *
     * @return string
     */
    public static function getName() {
        return 'Users';
    }

    /**
     * Handles the login of a user and thus assures the users authentication.
     *
     * @param $data
     *
     * @return
     */
    public static function handleUserLogin( array $data ) {
        $emptys = array();

        if ( ! isset( $data['user_email'] ) ) {
            $emptys[] = 'user_email';
        }
        if ( ! isset( $data['password'] ) ) {
            $emptys[] = 'password';
        }

        // Return the emptys.
        if ( count( $emptys ) ) {
            return array(
                'emptys' => $emptys
            );
        }

        $password = hash( 'sha256', $data['password'] );
        $username = Database::escapeString( $data['user_email'] );

        // Check if the user exits...
        $result = Database::query( "SELECT *
                                    FROM users
                                    WHERE email='$username'
                                      AND password='$password'" );

        if ( $result->num_rows ) {
            $user = new User( $result->fetch_assoc() );

            // Store the user information as a session variable.
            $_SESSION['user_id']   = $user->id;
            $_SESSION['user_pass'] = $password;

            // Redirect having been logged in.
            return array(
                'redirect' => 'manage'
            );
        }

        // There is no such entry.
        return array(
            'invalids' => array_keys( $data )
        );
    }

    /**
     * Loggs a user in from $_SESSION variables, confirming that users
     * validity.
     *
     * @return User
     */
    public static function getSessionUser() {
        // Ensure the session data exists
        if ( ! isset( $_SESSION['user_id'] ) ||
             ! isset( $_SESSION['user_pass'] ) ) {
            return 0;
        }

        // Ensure no one has hacked the $_SESSION data somehow.
        list( $id, $pass ) = Database::escapeString( $_SESSION['user_id'],
                                                     $_SESSION['user_pass'] );

        // Confrim the result by creating a user from the database.
        $res = Database::query( "SELECT *
                                 FROM users
                                 WHERE id=$id
                                   AND password='$pass'" );

        if ( $res && $res->num_rows ) {
            $data = $res->fetch_assoc();
            $res->close();
            return new self( $data );
        }

        // Return a empty value to indicate failure.
        return 0;
    }

    /// Variables as noted in mysql table.
    public $id;
    public $name;
    public $email;
    public $password;

    /**
     * Allow some typical validation of the user.
     *
     * @param array $args.
     * @param bool $validate
     */
    public function __construct( $args, $validate = false ) {
        // Perform the initialization of the arguments.
        parent::__construct( $args );

        // Check if should validate the users existance.
        if ( $validate ) {
            list( $name, $email, $password ) = Database::escapeString(
                $this->name, $this->email, $this->password
            );

            $res = Database::query( "SELECT id
                                     FROM users
                                     WHERE name='$name'
                                       AND email='$email'
                                       AND password='$password'" );
            if ( $this->id == $res->fetch_assoc()['id'] ) {
                // Passed validation...
            } else {
                throw new Exception( "Not Valid User $this->name" );
            }
        }
    }

    /**
     * The title of a user is given by the getTitle function, it is dispalyed
     * below.
     *
     * @return string
     */
    public function getTitle() {
        return $this->name;
    }

    /**
     * Print a string with the user rendered.
     *
     * @return string
     */
    public function __toString() {
        return htmlspecialchars( $this->name );
    }
}
