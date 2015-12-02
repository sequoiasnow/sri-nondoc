<?php
/**
 * Defines some standards that allowes the subject to be printed as a form.
 */
interface FormPrintable {
    /**
     * Return all the fields relevant to the form.
     *
     * @return [field]
     */
    public static function getFields();

    /**
     * Returns a description of the given form.
     *
     * @return string
     */
    public static function getDescription();

    /**
     * Retrurns a human readable name for the form.
     *
     * @return string
     */
    public static function getName();

    /**
     *
     */
    public static function getAction();
}
