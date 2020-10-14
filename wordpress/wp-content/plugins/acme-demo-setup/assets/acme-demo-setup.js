/**
 * Getting Started
 */
jQuery( document ).ready( function ( $ ) {

	$( '.ads-gsm-btn' ).click( function ( e ) {
		e.preventDefault();

		// Show updating gif icon.
        $( this ).addClass( 'updating-message' );

		// Change button text.
        $( this ).text( acme_demo_setup.btn_text );

		$.ajax({
			type: "POST",
			url: ajaxurl,
			data: {
                action     : 'acme_demo_setup_getting_started',
                security : acme_demo_setup.nonce
            },
			success:function( response ) {
                var redirect_uri;

				redirect_uri         = response.data.redirect;
                window.location.href = redirect_uri;
			},
			error: function( xhr, ajaxOptions, thrownError ){
				console.log(thrownError);
			}
		});
	} );
} );
