(function( $ ) {
    /**
     * A plugin for the updating and fetching of data for an attribute.
     */
    $.fn.getInstances = function( done ) {
        // The container to hold the children of this instace.
        var instances = this.find( 'ul.instances' ).first();

        // Will update the list of instances with appropriate id's below.
        var handleResponse = function( objects ) {
            // Remove all previous instances.
            this.find( 'li.instance:not(.add-new)' ).remove();

            var addnew = this.find( 'li.add-new' ).first();

            // Iterate over the objects and append them before the add button.
            for ( var i = 0; i < objects.length; i++  ) {
                var object = objects[i];

                // Create an html element from the object.
                addnew.before( $( '<li></li>', {
                    class: 'instance'
                }).html( object._title ).attr( 'data-id', object.id ) );
            }

            // Complte using the callback.
            done();
        }.bind( this );

        $.ajax({
            type: 'GET',
            url: 'api/' + this.attr( 'data-classname' ) + '/object',
            dataType: 'json'
        }).done( handleResponse )
          .error(function(  xhr ) {
              console.log( xhr.responseText );
          });
    };

    /**
     * Creates a form for the instance and returns it when complete, as a
     * jQuery object.
     *
     * I the object has an id the form is prefilled with data.
     */
    $.fn.getInstanceForm = function( done ) {
        var success = function( data ) {
            done( $( data ) );
        };

        var url = 'api/';

        // Get the parent content type.
        var contentType = this.parents( '.content-type' )
                              .first()
                              .attr( 'data-classname' );
        url += contentType + '/';

        // Check if the current item has an id.
        if ( this.attr( 'data-id' ) ) {
            url += this.attr( 'data-id' ) + '/';
        }

        url += 'form';

        $.ajax({
            type: 'GET',
            url: url,
        }).done( success )
          .error(function(  xhr ) {
              console.log( xhr.responseText );
          });
    };

    /**
     * Deletes a given instance with an id.
     *
     * @param callback done
     */
    $.fn.deleteInstance = function( done ) {
        // Nothing to delete.
        if ( ! this.attr( 'data-id' ) ) { return ''; }

        var contentType = this.parents( '.content-type' )
                              .first()
                              .attr( 'data-classname' );

        var id = this.attr( 'data-id' );

        var url = 'api/' + contentType + '/' + id;

        $.ajax({
            type: "DELETE",
            url: url,
        }).always(function() {
            done();
            // getAllInstances();
        });
    };

    /**
     * Returns a button used for the deletion of a node. Meant for the
     * submission of a form.
     */
    $.fn.getDeleteButton = function( done ) {
        var returnElement = $( '<button class="delete">Delete</button>' );

        var t = this;
        returnElement.bind( 'click', function() {
            if ( confirm( 'Are you sure you want to delete this content?' ) ) {
                t.deleteInstance( done );
            }
        });

        return returnElement;
    };
})( jQuery );

jQuery(document).ready(function($) {
    function bindAllInstanceForms() {
        $( '#content-types .content-type .instance' ).click(function() {
            var b = $( this ).getDeleteButton( getAllInstances );
            $( this ).getInstanceForm(function( form ) {
                // Allow for the deletion of the element.
                form.find( '.form-field.field-type-submit' ).append( b );

                // Add the form to the container.
                $( '#content-container' ).html( form );

                // Allow the form to be bound.
                $( 'form' ).each(function() {
                    $( this ).customForm(function() {
                        getAllInstances();
                    });
                });
            });

            // Allowes identification of what is the currently selected elem.
            $( '#content-types .clicked' ).removeClass( 'clicked' );
            $( this ).addClass( 'clicked' );
            $( this ).parents( '.content-type' ).addClass( 'clicked' );
        });
    }

    function getAllInstances() {
        $( '#content-types .content-type' ).each(function() {
            $( this ).getInstances( bindAllInstanceForms );
        });
    };

    getAllInstances();
});
