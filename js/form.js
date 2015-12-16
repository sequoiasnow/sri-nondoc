(function( $ ) {
    /**
     * Creates the basis of sending and recieveing a form as specified by the form
     * itself.
     *
     * Takes the action and uses ajax to get a response. The response is then
     * handled and returned back to the page as a json result.
     */
    $.fn.customForm = function( validresponse ) {
        // Handles the visual side of displaying the description
        var descCont = this.find( '.all-field-description' ).first();
        this.find( 'input' ).focus(function() {
            var desc = $( this ).siblings( '.field-description' );

            if ( ! desc ) {
                descCont.addClass( 'no-content' );
            } else {
                descCont.removeClass( 'no-content' );
                descCont.html( desc.html() );
            }
        });


        var action = this.attr( 'action' );

        var handleResponse = function( response ) {
            console.log( 'response: ', response );

            if ( response.invalids ) {
                for ( var key of response.invalids ) {
                    this.find( 'input[name="' + key + '"]' ).addClass( 'invalid' ).removeClass( 'valid empty' );
                }
            } else if ( response.redirect ) {
                console.log( 'redirecting' );

                window.location.replace( response.redirect );
            } else if ( response.emptys ) {

                for ( var key of response.emptys ) {
                    this.find( 'input[name="' + key + '"]' ).addClass( 'empty' ).removeClass( 'invalid valid' );
                }

            } else if ( response.errors ) {
                for ( var key of response.errors ) {
                    this.find( 'input[name="' + key + '"]' ).addClass( 'error' ).removeClass( 'invalid valid empty' );
                }
            } else {
                if ( validresponse ) {
                    // Assume all ok
                    validresponse();
                }
            }
        }.bind( this );

        var submitForm = function() {
            // Establish the form data.
            var formData = (function( form ) {
                var data = {};

                form.find( 'input, textarea' ).each(function() {
                    data[ $( this ).attr( 'name' ) ] = $( this ).val();
                });

                return data;
            })( this );

            console.log( 'Submission sent... awaiting response' );

            $.ajax({
                type: 'POST',
                url: action,
                data: formData,
                dataType: 'json'
            }).done( handleResponse )
              .error(function(  xhr ) {
                  console.log( xhr.responseText );
                  handleResponse( false );
              });
        }.bind(this);

        // Remove submit-on-return default.
        this.on( 'keyup keypress' , function( e ) {
            var code = e.keyCode || e.which;
            if ( code == 13 ) {
                e.preventDefault();
                return false;
            }
        });

        // Handle submit-on-return forms.
        this.find( 'input[submit-on-return]' ).keydown(function( e ) {

            if ( e.keyCode == 13 ) {
                submitForm();
                e.preventDefault();
                return false;
            }
        });

        // Handle a submit button
        this.find( 'submit, input[type="submit"]' ).mousedown(function( e ) {
            e.preventDefault();
            submitForm();
            return false;
        });

        // Disallow submits by typically means.
        this.submit(function( e ) {
            e.preventDefault();
        });
    }

})( jQuery );


/**
 * Apply the atomic form logic to every form
 */
jQuery(document).ready(function($) {
    $( 'form' ).each(function() {
        $( this ).customForm();
    });
});
;
