<?php

class NetworkData extends ContentType {
    /// The table name specified for this content type
    const TableName = 'network_data';

    /**
     * Return all the fields relevant to the form.
     *
     * @return [field]
     */
    public static function getFields() {
        return array(
            new TextField( array(
                'name'      => 'data',
                'public'    => array(
                    'title'       => 'Network Data',
                    'description' => 'Information concerning the speeds and
                                      names of various networks. Due to the
                                      complexity of the data it should be
                                      provided in double quoted json. This
                                      will be validated and checked by the
                                      form.',
                ),
                'validation' => function( $val ) {
                    // force to avoid errors.
                    return is_array( @json_decode( $val, true ) );
                },
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
            'data' => 'data',
        );
    }

    /**
     * Returns a description of the given form.
     *
     * @return string
     */
    public static function getDescription() {
        return 'Network data, this should only have one entry.';
    }

    /**
     * Retrurns a human readable name for the form.
     *
     * @return string
     */
    public static function getName() {
        return 'Network Data';
    }

    /// Variables in a coordance to the database values.
    public $id;
    public $data;

    /**
     * The name of an instance of the NavigationLink class.
     *
     * @return string
     */
    public function getTitle() {
        return 'Data';
    }

    /**
     * Print a navigation link in a cohesive fashion.
     *
     * @return string
     */
    public function __toString() {
        $graphData = json_decode( $this->data, true );

        // Sort the data based off of amount.
        usort( $graphData, function( $a, $b ) {
            if ( $a['value'] == $b['value'] ) {
                return 0;
            }

            return $a['value'] < $b['value'] ? 1 : -1;
        });


        return json_encode( $graphData );
    }
}
