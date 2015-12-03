<?php
/**
 * A field is given to allow functionality on the administrative end of the
 * site as well as to allow rendering of said field for thml output.
 *
 * A field should contian a description as well as a human readable name, to
 * allow display in the data_types.
 */
class Field implements ArrayAccess {
    /// Checks the attribute values to pull into attributes array, can be level
    /// one object.
    protected static $attrValues = array( 'id', 'name', 'class', 'placeholder' );

    /// The origional value of the field, unaltered.
    protected $rawValue;

    /// Origional arguments.
    protected $args;

    /**
     * Transforms a key value array into an html string of attributes.
     *
     * If there are no $values the defaults will be assumed.
     *
     * @param array
     *
     * @return string
     */
    protected function getAttrStr( array $values = null ) {
        // Creates a values array as a default.
        if ( ! $values ) {
            $values = isset( $this->args['attributes'] ) ? $this->args['attributes'] : array();

            // Use attribute values that could be stored as level one array.
            foreach ( self::$attrValues as $key ) {
                if ( ! isset( $values[$key] ) && isset( $this->args[$key] ) ) {
                    $values[$key] = $this->args[$key];
                }
            }
        }

        // Forms default string.
        $str = '';
        foreach ( $values as $key => $val ) {
            $str .= $key . '="' . $val . '" ';
        }
        return $str;
    }

    /**
     * Gets a public record is isset.
     *
     * @param string $key
     *
     * @return mixed
     */
    protected function getPublic( $key ) {
        if ( isset( $this->args['public'][$key] ) ) {
            return $this->args['public'][$key];
        } else if ( isset( $this->args["public_$key"] ) ) {
            return $this->args["public_$key"];
        }
        return null;
    }

    /**
     * Construct a field with given information concerning it.
     */
    public function __construct( $args ) {
        $this->args = $args;
    }

    /**
     * Returns the description if it exists.
     *
     * @return string
     */
    public function getDescription() {
        return $this->getPublic( 'description' );
    }

    /**
     * Returns the public name if exists.
     *
     * @return string
     */
    public function getTitle() {
        return $this->getPublic( 'title' );
    }

    /**
     * Implements array access...
     */

    /**
     * Returns the existance of a value at a given offset from the args array.
     *
     * @param string $offset
     *
     * @return bool
     */
    public function offsetExists( $offset ) {
        return isset( $this->args[$offset] );
    }

    /**
     * Unsets a value at a given value in the args array.
     *
     * @param string $offset
     *
     * @return mixed
     */
    public function offsetUnset( $offset ) {
        unset( $this->args[$offset] );
    }

    /**
     * Returns a value at a given offset from the args array.
     *
     * @param string $offset
     *
     * @return mixed
     */
    public function offsetGet( $offset ) {
        if ( isset( $this->args[$offset] ) ) {
            return $this->args[$offset];
        }
        return null;
    }

    /**
     * Sets a new valur for the args array
     *
     * @param string $offset
     * @param mixed $value
     */
    public function offsetSet( $offset, $value ) {
        $this->args[$offset] = $value;
    }
}


// Include all the fields...
include_once 'image_field.php';
include_once 'password_field.php';
include_once 'text_field.php';
include_once 'textarea_field.php';
