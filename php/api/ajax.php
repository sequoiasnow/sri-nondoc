<?php
/**
 * Defines a standard for the implementation of ajax retreivable data.
 */
interface AjaxRetrievable {
    /**
     * Returns an array that maps form name to the variable name of the object.
     * Typically that variable name would be the mysql column name as well.
     *
     * If a value is provided as null, no field value need be passed.
     *
     * @return array
     */
    public static function getFormFieldMap();

    /**
     * Returns the title of the instance based off of whichever field or other
     * factor it decides.
     *
     * @return stirng
     */
    public function getTitle();

    /**
     * Allowes the form of the content to be returned as a string.
     *
     * @return string
     */
    public function __toString();
}
