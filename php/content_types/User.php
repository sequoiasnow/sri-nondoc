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
            ) ),
            new TextField( array(
                'name'   => 'user_email',
                'public' => array(
                    'title'       => 'Email',
                    'description' => 'The user email, ensure this is a valid
                                      email. This will largelly be used to
                                      reset passwords if need be.',
                ),
            ) ),
            new PasswordField( array(
                'name'   => 'user_password_1',
                'public' => array(
                    'title'       => 'Password',
                    'description' => 'A unique password, please use at least
                                      8 characters, the more the better.',
                ),
            ) ),

            new PasswordField( array(
                'name'   => 'user_password_2',
                'public' => array(
                    'title'       => 'Confirm Password',
                    'description' => '',
                ),
            ) ),
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
     * Returns the action to be taken, as a string.
     *
     * @return Action
     */
    public static function getAction() {
        return new Action( array(  __CLASS__, 'handleFormSubmit' ) );
    }

    /**
     * Handles the submital of a form. What is returned is given here to be
     * acted upon as the form is validated. Typically the response is governed
     * by ajax, thus, while header function will work, it is preffered to return
     * and array which will dictate the manner of response.
     *
     * @param array $data
     *
     * @return array
     */
    public static function handleFormSubmit( array $data ) {
        // Required fields.
        $required = array(
            'user_name', 'user_email', 'user_password_1', 'user_password_2'
        );

        // Any errors that may crop up are here displayed.
        $invalids = array();
        $emptys    = array();

        // Check for any emptys.
        foreach ( $required as $key ) {
            if ( ! isset( $data[$key] ) ) {
                $emptys[]   = $key;
                $data[$key] = '';
            }
        }

        // Check against emails.
        if ( ! filter_var( $data['user_email'], FILTER_VALIDATE_EMAIL ) ) {
            $invalids[] = $data['user_email'];
        }

        // Check the passwords match.
        if ( $data['user_password_1'] != $data['user_password_2'] ) {
            $invalids[] = array( 'user_password_1', 'user_password_2' );
        }


        // Determine the correct action to take.
        $returnArray = array();
        if ( count( $invalids ) ) {
            $returnArray['invalids'] = $invalids;
        }

        if ( count( $emptys ) ) {
            $returnArray['emptys'] = $emptys;
        }

        if ( ! count( $returnArray ) ) {
            // Insert into the database.





            $returnArray['successs'] = true;
        }

        return $returnArray;
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

        if ( ! isset( $data['user_name'] ) ) {
            $emptys[] = 'user_name';
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
        $username = Database::escapeString( $data['user_name'] );

        // Check if the user exits...
        $result = Database::query( "SELECT *
                                    FROM users
                                    WHERE name='$username'
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
        } else {
            // There is no such entry.
            return array(
                'invalids' => array_keys( $data )
            );
        }
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
        foreach ( $args as $k => $v ) {
            $this->$k = $v;
        }

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
}
