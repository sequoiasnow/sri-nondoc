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
    private $rawValue;

    /**
     * Construct a field with given information concerning it.
     */
    public function __construct() {

    }

    public function __toString() {

    }
}
