<?php
/**
 * Implements the ContentType abstract class and is used to store navigation
 * links in the database using the navigation_links table.
 *
 * @see init/mysql/NavigationLink.mysql
 */
class Image extends ContentType {
    /// The table name specified for this content type
    const TableName = 'image';

    /**
     * Allowes the upload of imagea by changing some attributes of the form
     *
     * @return array
     */
    public static function getFormAttrs() {
        return array(
            'enctype' => 'multipart/form-data',
        );
    }

    /**
     * Creates a link to the actual image that works for web aplications, or
     * file opperations.
     *
     * @param stirng $image
     *
     * @return string
     */
    public static function get_path( $image ) {
        if ( strpos( $image, 'http' ) === false ) {
            return "files/images/$image";
        }
        return $image;
    }

    /**
     * Validates an image given all the form data returned. This function is
     * actually passed as the vaildation parameter for the ImageField.
     *
     * @param array $form
     *
     * @return bool
     */
    public static function uploadImage( $form ) {
        // Directory where all images are kept.
        $targetFile = ROOT_DIR . '/' . self::get_path( $form['path'] );

        // Determine the file path in order to allow for validation.
        $imageFileType = pathinfo($targetFile, PATHINFO_EXTENSION);

        // Check if image file is a actual image or fake image
        if( isset( $_POST['submit'] ) ) {
            $check = getimagesize( $_FILES["image_upload"]["tmp_name"] );

            if( $check === false ) {
                // Is not an image.
                return false;
            }
        }

        // Check if file already exists
        if ( file_exists( $targetFile ) ) {
            return false;
        }
        // Check file size
        if ( $_FILES["image_upload"]["size"] > 10000000 ) {
            return false;
        }

        return move_uploaded_file( $_FILES["image_upload"]["tmp_name"],
                                   $targetFile );

    }

    /**
     * Return all the fields relevant to the form.
     *
     * @return [field]
     */
    public static function getFields() {
        return array(
            new TextField( array(
                'name'   => 'path',
                'public' => array(
                    'title'       => 'Image Name',
                    'description' => 'The name you would like to give this
                                      image. Specificly this should be a url
                                      readable string, you can use this later
                                      where an image is needed, such as a person
                                      depiction.',
                ),
                'validation' => function( $path ) {
                    return ! file_exists( self::get_path( $path ) );
                }
            ) ),
            new FileField( array(
                'name'       => 'image_upload',
                'validation' => function( $current, $form ) {
                    return Image::uploadImage( $form );
                },
                'required'   => false,
                'public'     => array(
                    'title' => 'Image',
                    'description' => 'Chose an image to upload.',
                ),
            ) ),
            new HiddenField( array(
                'name'  => '__REDIRECT_TO',
                'value' => 'manage',
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
            'path' => 'path',
        );
    }

    /**
     * Returns a description of the given form.
     *
     * @return string
     */
    public static function getDescription() {
        return 'An image is a place to store some data concerning images.';
    }

    /**
     * Retrurns a human readable name for the form.
     *
     * @return string
     */
    public static function getName() {
        return 'Images';
    }

    /// Variables in a coordance to the database values.
    public $id;
    public $path;

    /**
     * The name of an instance of the NavigationLink class.
     *
     * @return string
     */
    public function getTitle() {
        return $this->path;
    }

    /**
     * Actually performs an image delete, not only removing this instance
     * from the database but also removing the file it represents.
     */
    public function delete() {
        if ( file_exists( ROOT_DIR . '/' . self::get_image( $this->path ) ) ) {
            unlink( ROOT_DIR . '/' . self::get_image( $this->path ) );
        }
    }
}
