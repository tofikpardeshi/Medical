let blocksStatus = GUTENTOR_BLOCKS.status;

if( typeof wp.blocks.unregisterBlockType !== "undefined" ){
	Object.keys( blocksStatus ).map( function( key ){
		if( blocksStatus[ key ] === 'disabled' ){
			wp.blocks.unregisterBlockType( 'gutentor/' + key );
		}
	});
}