( function ( wp ) {
	if ( ! wp?.blocks?.registerBlockBindingsSource ) {
		return;
	}

	const fields = window.agcSettingsFields || {};

	wp.blocks.registerBlockBindingsSource( {
		name: 'agc/settings',
		getValues( { bindings } ) {
			const values = {};
			for ( const [ attribute, binding ] of Object.entries( bindings ) ) {
				const key = binding.args?.key;
				values[ attribute ] = fields[ key ]?.value ?? key;
			}
			return values;
		},
		canUserEditValue: () => false,
		getFieldsList() {
			return Object.entries( fields ).map( ( [ key, field ] ) => ( {
				label: field.label,
				type: 'string',
				args: { key },
			} ) );
		},
	} );
} )( window.wp );
