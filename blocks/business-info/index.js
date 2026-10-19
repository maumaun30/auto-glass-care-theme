( function ( wp ) {
	const { registerBlockType } = wp.blocks;
	const { createElement: el } = wp.element;
	const { useBlockProps, InspectorControls } = wp.blockEditor;
	const { PanelBody, SelectControl, TextControl, ToggleControl } = wp.components;
	const ServerSideRender = wp.serverSideRender;
	const { __ } = wp.i18n;

	const FIELDS = [
		{ value: 'phone', label: __( 'Phone', 'auto-glass-care' ) },
		{ value: 'email', label: __( 'Email', 'auto-glass-care' ) },
		{ value: 'address', label: __( 'Address', 'auto-glass-care' ) },
		{ value: 'hours', label: __( 'Hours', 'auto-glass-care' ) },
		{ value: 'business_name', label: __( 'Business name', 'auto-glass-care' ) },
		{ value: 'tagline', label: __( 'Tagline', 'auto-glass-care' ) },
		{ value: 'subtagline', label: __( 'Secondary tagline', 'auto-glass-care' ) },
		{ value: 'service_areas', label: __( 'Service areas', 'auto-glass-care' ) },
	];

	registerBlockType( 'agc/business-info', {
		edit( { attributes, setAttributes } ) {
			return el(
				'div',
				useBlockProps(),
				el(
					InspectorControls,
					null,
					el(
						PanelBody,
						{ title: __( 'Value', 'auto-glass-care' ) },
						el( SelectControl, {
							label: __( 'Theme Settings field', 'auto-glass-care' ),
							value: attributes.field,
							options: FIELDS,
							onChange: ( field ) => setAttributes( { field } ),
							__nextHasNoMarginBottom: true,
						} ),
						el( TextControl, {
							label: __( 'Label', 'auto-glass-care' ),
							help: __( 'Optional text before the value, e.g. "Call:"', 'auto-glass-care' ),
							value: attributes.label,
							onChange: ( label ) => setAttributes( { label } ),
							__nextHasNoMarginBottom: true,
						} ),
						el( ToggleControl, {
							label: __( 'Link value (tel:, mailto:, map)', 'auto-glass-care' ),
							checked: attributes.isLink,
							onChange: ( isLink ) => setAttributes( { isLink } ),
							__nextHasNoMarginBottom: true,
						} )
					)
				),
				el( ServerSideRender, { block: 'agc/business-info', attributes, skipBlockSupportAttributes: true } )
			);
		},
		save: () => null,
	} );
} )( window.wp );
