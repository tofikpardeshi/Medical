( function( api ) {

	// Extends our custom "medical-circle" section.
	api.sectionConstructor['medical-circle'] = api.Section.extend( {

		// No events for this type of section.
		attachEvents: function () {},

		// Always make the section active.
		isContextuallyActive: function () {
			return true;
		}
	} );

} )( wp.customize );