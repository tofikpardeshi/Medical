
/**
 * Alpha Color Picker JS
 *
 * This file includes several helper functions and the core control JS.
 */

/**
 * Override the stock color.js toString() method to add support for
 * outputting RGBa or Hex.
 */
Color.prototype.toString = function( flag ) {

	// If our no-alpha flag has been passed in, output RGBa value with 100% opacity.
	// This is used to set the background color on the opacity slider during color changes.
	if ( 'no-alpha' == flag ) {
		return this.toCSS( 'rgba', '1' ).replace( /\s+/g, '' );
	}

	// If we have a proper opacity value, output RGBa.
	if ( 1 > this._alpha ) {
		return this.toCSS( 'rgba', this._alpha ).replace( /\s+/g, '' );
	}

	// Proceed with stock color.js hex output.
	var hex = parseInt( this._color, 10 ).toString( 16 );
	if ( this.error ) { return ''; }
	if ( hex.length < 6 ) {
		for ( var i = 6 - hex.length - 1; i >= 0; i-- ) {
			hex = '0' + hex;
		}
	}
	return '#' + hex;
};

/**
 * Given an RGBa, RGB, or hex color value, return the alpha channel value.
 */
function acp_get_alpha_value_from_color( value ) {
	var alphaVal;

	// Remove all spaces from the passed in value to help our RGBa regex.
	value = value.replace( / /g, '' );

	if ( value.match( /rgba\(\d+\,\d+\,\d+\,([^\)]+)\)/ ) ) {
		alphaVal = parseFloat( value.match( /rgba\(\d+\,\d+\,\d+\,([^\)]+)\)/ )[1] ).toFixed(2) * 100;
		alphaVal = parseInt( alphaVal );
	} else {
		alphaVal = 100;
	}

	return alphaVal;
}

/**
 * Force update the alpha value of the color picker object and maybe the alpha slider.
 */
 function acp_update_alpha_value_on_color_control( alpha, $control, $alphaSlider, update_slider ) {
	var iris, colorPicker, color;

	iris = $control.data( 'a8cIris' );
	colorPicker = $control.data( 'wpWpColorPicker' );

	// Set the alpha value on the Iris object.
	iris._color._alpha = alpha;

	// Store the new color value.
	color = iris._color.toString();

	// Set the value of the input.
	$control.val( color );


    // Update the background color of the color picker.
	colorPicker.toggler.css({
		'background-color': color
	});

	// Maybe update the alpha slider itself.
	if ( update_slider ) {
		acp_update_alpha_value_on_alpha_slider( alpha, $alphaSlider );
	}

	// Update the color value of the color picker object.
	$control.wpColorPicker( 'color', color );
}

/**
 * Update the slider handle position and label.
 */
function acp_update_alpha_value_on_alpha_slider( alpha, $alphaSlider ) {
	$alphaSlider.slider( 'value', alpha );
	$alphaSlider.find( '.ui-slider-handle' ).text( alpha.toString() );
}

function alpha_color_control( wrap, $ ){
    // Loop over each control and transform it into our color picker.
    wrap.find( '.alpha-color-control' ).each( function() {

        // Scope the vars.
        var $control, startingColor, showOpacity, defaultColor, colorPickerOptions,
            $container, $alphaSlider, alphaVal, sliderOptions;

        // Store the control instance.
        $control = $( this );

        // Get a clean starting value for the option.
        startingColor = $control.val().replace( /\s+/g, '' );

        // Get some data off the control.
        showOpacity  = $control.attr( 'data-show-opacity' );
        defaultColor = $control.attr( 'data-default-color' );

        // Set up the options that we'll pass to wpColorPicker().
        colorPickerOptions = {

            change: _.throttle( function(event, ui) { // For Customizer
                var key, value, alpha, $transparency;

                key = $control.attr( 'data-customize-setting-link' );
                value = $control.wpColorPicker( 'color' );

                // Set the opacity value on the slider handle when the default color button is clicked.
                if ( defaultColor == value ) {
                    alpha = acp_get_alpha_value_from_color( value );
                    $alphaSlider.find( '.ui-slider-handle' ).text( alpha );
                }

                // Send ajax request to wp.customize to trigger the Save action.
                wp.customize( key, function( obj ) {
                    obj.set( value );
                });

                $transparency = $container.find( '.transparency' );

                // Always show the background color of the opacity slider at 100% opacity.
                $transparency.css( 'background-color', ui.color.toString( 'no-alpha' ) );

                $control.trigger('change');
            }, 3000 ),
            palettes: gutentorLocalize.colorPalettes // Use the passed in palette.
        };

        // Create the colorpicker.
        $control.wpColorPicker( colorPickerOptions );

        $container = $control.parents( '.wp-picker-container:first' );

        // Insert our opacity slider.
        $( '<div class="alpha-color-picker-container">' +
            '<div class="min-click-zone click-zone"></div>' +
            '<div class="max-click-zone click-zone"></div>' +
            '<div class="alpha-slider"></div>' +
            '<div class="transparency"></div>' +
            '</div>' ).appendTo( $container.find( '.wp-picker-holder' ) );

        $alphaSlider = $container.find( '.alpha-slider' );

        // If starting value is in format RGBa, grab the alpha channel.
        alphaVal = acp_get_alpha_value_from_color( startingColor );

        // Set up jQuery UI slider() options.
        sliderOptions = {
            create: function( event, ui ) {
                var value = $( this ).slider( 'value' );

                // Set up initial values.
                $( this ).find( '.ui-slider-handle' ).text( value );
                $( this ).siblings( '.transparency ').css( 'background-color', startingColor );
            },
            value: alphaVal,
            range: 'max',
            step: 1,
            min: 0,
            max: 100,
            animate: 300
        };

        // Initialize jQuery UI slider with our options.
        $alphaSlider.slider( sliderOptions );

        // Maybe show the opacity on the handle.
        if ( 'true' == showOpacity ) {
            $alphaSlider.find( '.ui-slider-handle' ).addClass( 'show-opacity' );
        }

        // Bind event handlers for the click zones.
        $container.find( '.min-click-zone' ).on( 'click', function() {
            acp_update_alpha_value_on_color_control( 0, $control, $alphaSlider, true );
        });
        $container.find( '.max-click-zone' ).on( 'click', function() {
            acp_update_alpha_value_on_color_control( 100, $control, $alphaSlider, true );
        });

        // Bind event handler for clicking on a palette color.
        $container.find( '.iris-palette' ).on( 'click', function() {
            var color, alpha;

            color = $( this ).css( 'background-color' );
            alpha = acp_get_alpha_value_from_color( color );

            acp_update_alpha_value_on_alpha_slider( alpha, $alphaSlider );

            // Sometimes Iris doesn't set a perfect background-color on the palette,
            // for example rgba(20, 80, 100, 0.3) becomes rgba(20, 80, 100, 0.298039).
            // To compensante for this we round the opacity value on RGBa colors here
            // and save it a second time to the color picker object.
            if ( alpha != 100 ) {
                color = color.replace( /[^,]+(?=\))/, ( alpha / 100 ).toFixed( 2 ) );
            }

            $control.wpColorPicker( 'color', color );
        });

        // Bind event handler for clicking on the 'Clear' button.
        $container.find( '.button.wp-picker-clear' ).on( 'click', function() {
            var key = $control.attr( 'data-customize-setting-link' );
            // The #fff color is delibrate here. This sets the color picker to white instead of the
            // defult black, which puts the color picker in a better place to visually represent empty.
            $control.wpColorPicker( 'color', '' );

            // Set the actual option value to empty string.
            wp.customize( key, function( obj ) {
                obj.set( '' );
            });

            acp_update_alpha_value_on_alpha_slider( 100, $alphaSlider );
        });

        // Bind event handler for clicking on the 'Default' button.
        $container.find( '.button.wp-picker-default' ).on( 'click', function() {
            var alpha = acp_get_alpha_value_from_color( defaultColor );

            acp_update_alpha_value_on_alpha_slider( alpha, $alphaSlider );
        });

        // Bind event handler for typing or pasting into the input.
        $control.on( 'input', function() {
            var value = $( this ).val();
            var alpha = acp_get_alpha_value_from_color( value );

            acp_update_alpha_value_on_alpha_slider( alpha, $alphaSlider );
        });

        // Update all the things when the slider is interacted with.
        $alphaSlider.slider().on( 'slide', function( event, ui ) {
            var alpha = parseFloat( ui.value ) / 100.0;

            acp_update_alpha_value_on_color_control( alpha, $control, $alphaSlider, false );

            // Change value shown on slider handle.
            $( this ).find( '.ui-slider-handle' ).text( ui.value );
        });

    });
}

/**
 * Initialization trigger.
 */
jQuery( document ).ready( function( $ ) {
    alpha_color_control( $('body'), $ );
});

/**
 * Group JS
 * */
( function( $ ) {
    /*Drag and drop to change order*/
    $(document).ready(function () {
        var customize_theme_controls = $(document);

        function refresh_group_cssbox_values( control_cssbox_wrap ){
            var valueToPush = {};
            control_cssbox_wrap.find('.gutentor-groupcssbox-field').each(function(){

                var device = $(this).attr('data-device'),
                    dataName = $(this).attr('data-cssbox-name');

                if(typeof valueToPush[device] === 'undefined') {
                    valueToPush[device] = {};
                }
                if( $(this).attr('type') === 'checkbox'){
                    if($(this).is(':checked')){
                        var dataValue = 1;
                    }
                    else {
                        var dataValue = '';
                    }
                }
                else{
                    var dataValue = $(this).val();
                }
                valueToPush[device][dataName] = dataValue;
            });

            return valueToPush;
        }


        function refresh_group_values( control_wrap ){
            var valueToPush = {};
            control_wrap.find('[data-single-name]').each(function(){
                if( $(this).attr('type') === 'checkbox'){
                    if($(this).is(':checked')){
                        var dataValue = 1;
                    }
                    else {
                        var dataValue = '';
                    }
                }
                else{
                    var dataValue = $(this).val();
                }
                var dataName = $(this).attr('data-single-name');
                valueToPush[dataName] = dataValue;
            });
            control_wrap.find('.responsive-switchers-fields').each(function(){
                var responsiveValue = {},
                    responsive_wrap = $(this),
                    desktop_value = responsive_wrap.find('.group-desktop').val(),
                    tablet_value = responsive_wrap.find('.group-tablet').val(),
                    mobile_value = responsive_wrap.find('.group-mobile').val();

                responsiveValue['desktop']= desktop_value;
                responsiveValue['tablet']= tablet_value;
                responsiveValue['mobile']= mobile_value;

                var dataName = responsive_wrap.attr('data-responsive-name');
                valueToPush[dataName] = responsiveValue;

            });

            control_wrap.find('.responsive-switchers-cssboxfields').each(function(){
                var responsive_wrap = $(this);
                var dataName = responsive_wrap.attr('data-responsive-name');
                valueToPush[dataName] = refresh_group_cssbox_values( responsive_wrap );

            });
            control_wrap.next('.gutentor-group-collection').val(JSON.stringify(valueToPush)).trigger('change');
        }

        customize_theme_controls.on('click','.accordion-section-title',function(){
            var this_field_title =  $(this),
                group_field_control = this_field_title.closest('.gutentor-group-field-control');

            group_field_control.toggleClass('expanded');
            group_field_control.find('.group-fields').slideToggle();
            group_field_control.find('.group-fields').trigger('cosmoswp_group_slide_toggle');
        });
        customize_theme_controls.on('click', '.group-field-close', function(){
            $(this).closest('.group-fields').slideUp();
            $(this).closest('.gutentor-group-field-control').toggleClass('expanded');
        });


        customize_theme_controls.on('keyup change', '.gutentor-group-field-control-wrap [data-single-name], .gutentor-group-field-control-wrap [data-cssbox-name], .responsive-range',function(){

            var group_field = $(this),
                control_wrap = $(this).closest(".gutentor-group-field-control-wrap");
            
            if( group_field.hasClass('gutentor-groupcssbox-field') ){
                if( !group_field.hasClass('groupcssbox_link') ){
                    var dataValue = group_field.val(),
                        device_wrap = group_field.closest('.groupcssbox-device-wrap');

                    if( device_wrap.find('.groupcssbox_link').is(':checked') ){
                        device_wrap.find('.gutentor-groupcssbox-field').each(function(){
                            $(this).val(dataValue);
                        });
                    }
                }
            }
            
            refresh_group_values(control_wrap);
            return false;
        });

        function cosmoswp_group_field_border_style_control(group_field){

            var selectParent        = group_field.parent(),
                select_data_attr    = group_field.attr('data-single-name');
            if(select_data_attr === 'border-style'){
                var selected_val = group_field.find(":selected").val();
                if(selected_val === 'none'){
                    selectParent.siblings().find('.responsive-switchers-cssboxfields').each(function () {
                        var width = $(this).data('responsive-name');
                        if (width === 'border-width') {
                            $(this).parent().hide();
                        }
                    });
                    selectParent.siblings().find('.customize-control-alpha-color').each(function () {
                        var color = $(this).data('color-single-name');
                        if (color === 'border-color') {
                            $(this).parent().hide();
                        }
                    });
                }
                else{
                    selectParent.siblings().show();
                }
            }
        }

        function cosmoswp_group_field_check_overlay_color_control(group_field){

            var selectParent        = group_field.parent().closest(".single-field"),
                select_data_attr    = group_field.attr('data-single-name'),
                control_wrap        = $(this).closest(".gutentor-group-field-control-wrap"),
                image_preview_wrap   = selectParent.siblings().find('.img-preview-wrap');

            if( select_data_attr === 'enable-overlay' ){
                var img = image_preview_wrap.find("img"),
                    img_len = img.length,
                    image_src = '';
                if( img_len > 0 ){
                    image_src = img.attr("src") ;
                }
                else{
                    image_src = false;
                }
                var selected_val = group_field.is(":checked");
                if(selected_val && image_src){
                    selectParent.siblings().find('.customize-control-alpha-color').each(function () {
                        var color = $(this).data('color-single-name');
                        if (color === 'background-overlay-color') {
                            $(this).parent().show();
                        }
                    });
                }
                else{
                    selectParent.siblings().find('.customize-control-alpha-color').each(function () {
                        var color = $(this).data('color-single-name');
                        if (color === 'background-overlay-color') {
                            $(this).parent().hide();
                        }
                    });
                }
            }
        }

        customize_theme_controls.on('change', '.gutentor-group-field-control-wrap select[data-single-name]',function(){
            cosmoswp_group_field_border_style_control($(this))
        });

        customize_theme_controls.find('.gutentor-group-field-control-wrap select[data-single-name]').each(function(){
            cosmoswp_group_field_border_style_control($(this))
        });

        customize_theme_controls.on('change', '.gutentor-group-field-control-wrap input[type="checkbox"]',function(){
            cosmoswp_group_field_check_overlay_color_control($(this))
        });

        customize_theme_controls.find('.gutentor-group-field-control-wrap input[type="checkbox"]').each(function(){
            cosmoswp_group_field_check_overlay_color_control($(this))
        });


        /*Image*/
        customize_theme_controls.on('click','.gutentor-image-upload', function(e){

            // Prevents the default action from occuring.
            e.preventDefault();
            var media_image_upload = $(this);
            var media_title = $(this).data('title');
            var media_button = $(this).data('button');
            var media_input_val = $(this).siblings('.image-value-url');
            var media_image_url = $(this).siblings('.img-preview-wrap');
            var media_image_url_value = media_image_url.children('img');


            var meta_image_frame = wp.media.frames.meta_image_frame = wp.media({
                title: media_title,
                button: { text:  media_button },
                library: { type: 'image' }
            });

            // Opens the media library frame.
            meta_image_frame.open();
            // Runs when an image is selected.
            meta_image_frame.on('select', function(){

                // Grabs the attachment selection and creates a JSON representation of the model.
                var media_attachment = meta_image_frame.state().get('selection').first().toJSON();

                // Sends the attachment URL to our custom image input field.
                media_input_val.val(media_attachment.url).trigger('change');
                if( media_image_url_value !== null ){
                    media_image_url_value.attr( 'src', media_attachment.url );
                    media_image_url.show();
                }
            });
        });
        
        // Runs when the image button is clicked.
        customize_theme_controls.on('click','.gutentor-image-remove', function(e){
            $(this).siblings('.img-preview-wrap').hide();
            $(this).prev().prev().val('');
            $(this).parent().siblings().find('.customize-control-alpha-color').each(function () {
                var color = $(this).data('color-single-name');
                if (color === 'background-overlay-color') {
                    $(this).parent().hide();
                }
            });
        });
    })
} )( jQuery );