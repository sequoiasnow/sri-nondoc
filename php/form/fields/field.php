<?php
/**
 * A field is given to allow functionality on the administrative end of the
 * site as well as to allow rendering of said field for thml output.
 *
 * A field should contian a description as well as a human readable name, to
 * allow display in the data_types.
 */
class Field {
    /// The origional value of the field, unaltered.
    protected $rawValue;

    /// Origional arguments.
    protected $args;

    /**
     * Transforms a key value array into an html string of attributes.
     *
     * @param array
     *
     * @return string
     */
    protected function getAttrStr( array $values ) {
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
}
