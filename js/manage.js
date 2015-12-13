(function( $ ) {
    /**
     * A plugin for the updating and fetching of data for an attribute.
     */
    $.fn.getInstances = function( done ) {
        // The container to hold the children of this instace.
        var instances = this.find( 'ul.instances' ).first();

        // Data is related to the current instance.
        var data = {
            action: 'get',
            request: 'content',
            returnType: 'object',
            contentType: this.attr( 'data-classname' )
        };

        // Will update the list of instances with appropriate id's below.
        var handleResponse = function( objects ) {
            var addnew = this.find( 'li.add-new' ).first();

            // Iterate over the objects and append them before the add button.
            for ( var i = 0; i < objects.length; i++  ) {
                var object = objects[i];

                // Create an html element from the object.
                addnew.before( $( '<li></li>', {
                    className: 'instance'
                }).html( object.id ) );
            }

            // Complte using the callback.
            done();
        }.bind( this );

        $.ajax({
            type: 'POST',
            url: 'ajax_handler.php',
            data: data,
            dataType: 'json'
        }).done( handleResponse )
          .error(function(  xhr ) {
              console.log( xhr.responseText );
          });
    };

    /**
     * Creates a form for the instance and places the form in the
     * #content-container
     */
    $.fn.getInstanceForm = function() {
        var success = function() {

        };

        $.ajax({
            type: 'POST',
            url: 'ajax_handler.php',
            data: {
                action: 'get',
                request: 'form',
                returnType: 'rendered',
                contentType: this.attr( 'data-id' )
            },
            dataType: 'json'
        }).done( success );
    }
})( jQuery );

jQuery(document).ready(function($) {
    $( '#content-types .content-type' ).each(function() {
        $( this ).getInstances();
    });
});
