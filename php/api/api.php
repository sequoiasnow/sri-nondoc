<?php
require 'actions.php';
require 'ajax.php';

/**
 * Defines the type of data the api can return.
 */
abstract class ApiReturnType {
    const Form     = 'form';
    const Rendered = 'rendered';
    const Data     = 'object';
}

/**
 * Defines the various types of request methods that can be used to access the
 * api.
 */
abstract class ApiRequestMethod {
    /// Returns data concerning an object or a content type.
    const Get    = 'GET';

    /// Adds a new instance of a type.
    const Put    = 'PUT';

    /// Updates an instance of a type, must provide an id.
    const Update = 'POST';

    /// Deletes an instance of a type.
    const Delete = 'DELETE';
}


/**
 * Defines a method for the retrieval of any type of data from the application.
 *
 * Typically used by javascript and not cross platform due to the nature of
 * this applcication, being a single domain type api.
 */
class API {
    /**
     * Determines the type of request being dolled out by the server.
     *
     * Also determines the request data for the object.
     */
    private function getRequestType() {
        $method =  $_SERVER['REQUEST_METHOD'];

        switch ( $method ) {
            case ApiRequestMethod::Put:
                parse_str( file_get_contents( 'php://input' ),
                           $this->requestData );
                break;
            case ApiRequestMethod::Update:
                $this->requestData = $_POST;
                break;
            case ApiRequestMethod::Delete:
                break;
            case ApiRequestMethod::Get:
                $this->requestData = $_GET;
                break;
        }

        return $method;
    }

    /**
     * Establishes the objects for the return of the api. All return objects are
     * stored as ApiReturnType::Data and can be rendered by the __toString
     * method.
     */
    private function establishGetObjects() {
        // Establish the table name.
        $tableName = $this->contentType::TableName;

        if ( $this->id ) {
            // Deliver singular content if has an id.
            $sql = "SELECT * FROM $tableName WHERE id=$id";
            $res = Database::query( $sql );

            if ( $row = $res->fetch_assoc() ) {
                // Establish a new object of that type to be outputed.
                if ( $this->returnType == ApiReturnType::Data ) {
                    $this->objects = new $this->contentType( $row );
                } else if ( $this->returnType == ApiReturnType::Rendered ) {
                    $this->objects = '' . new $this->contentType( $row );
                }
            }

            $res->close();
        } else if ( $this->returnType == ApiReturnType::Form ) {
            // Simply get the rendered form and add it to the objects array.
            $this->objects = '' . Form::createForm( $this->contentType );
        } else {
            // If their are mutliple content types asked deliver them all.
            $res = Database::query( "SELECT * FROM $tableName" );

            if ( $this->returnType == ApiReturnType::Data ) {
                $this->objects = array();
            } else {
                $this->objects = '';
            }

            while ( $row = $res->fetch_assoc() ) {
                $this->objects[] = new $this->contentType( $row );
                if ( $this->returnType == ApiReturnType::Data ) {
                    $this->objects[] = new $this->contentType( $row );
                } else {
                    $this->objects .= ''. new $this->contentType( $row );
                }
            }
        }
    }

    /**
     * Deletes an element of a content type with that id. This requires
     * authentication.
     */
    private function performDelete() {
        if ( ! $this->contentType || ! $this->id ) {
            throw new Exception( 'A content type and an id are necessary.' );
        }

        // Check that the content type does in fact exits.
        if ( ! class_exists( $this->contentType ) ) {
            throw new Exception( 'Not a valid content type.' );
        }

        // Establish information about the content type.
        $tableName = $this->contentType::TableName;

        // Ensure the id also exists.
        $res = Database::query( "SELECT * FROM $tableName WHERE id=$this->id" );
        if ( ! $res->num_rows ) {
            throw new Exception( 'Not a valid id.' );
        }
        $res->close();
        // Perform the delete.
        Database::query( "DELETE FROM $tableName WHERE id=$this->id" );
    }

    /**
     * Constructs a new instance of the Api which interacts with the database.
     * The result is outputed as json.
     *
     * The manner of the action is determined by the type of request. If the
     * request is 'get' then the action is read, if the request is post, the
     * action is write.
     *
     * @param string $url
     * @param string $requestType
     */
    public function __construct( $url, $requestType = false ) {
        // Determine the nature of the url.
        $args = str_split( '/'. $url );

        // Splits up the conent type by the number of offsets.
        if ( isset( $args[0] ) ) {
            $this->contentType = $args[0];
        }
        if ( isset( $args[1] ) ) {
            // If this is an id .
            if ( is_numeric( $args[1] ) ) {
                $this->id = $args[1];

                // Tells the return type if there is one, else assume data.
                if ( isset( $args[2] ) ) {
                    $this->returnType = $args[2];
                } else {
                    $this->returnType = ApiReturnType::Data;
                }
            } else {
                // Tells the return type.
                $this->returnType = $args[1];
            }
        }

        // Determine the $requestType
        if ( ! $requestType ) {
            $requestType = $this->getRequestType();
        }
        $this->requestType = $requestType;

        // Determine the action based off of the request type.
        switch ( $requestType ) {
            case ApiRequestMethod::Put:
                break;
            case ApiRequestMethod::Update:

                break;
            case ApiRequestMethod::Delete:
                $this->performDelete();
                break;
            case ApiRequestMethod::Get:
                $this->establishGetObjects();
                break;
        }
    }

    /**
     * Returns whatever is currently in the objects array.
     */
    public function getResult() {
        return $this->objects;
    }

    /**
     * Prints the requested data as a json object or complete text.
     *
     * This depends on the nature of the return_type parameter.
     */
    public function __toString() {
        if ( $this->returnType == ApiReturnType::Data ) {
            // Render the header for json.
            header( 'Content-Type: application/json' );

            return json_encode( $this->objects );
        } else {
            return $this->objects;
        }
    }
}
