( function ( wp ) {
	const { registerBlockType } = wp.blocks;
	const { createElement: el } = wp.element;
	const { useBlockProps, InspectorControls } = wp.blockEditor;
	const { PanelBody, TextControl, ToggleControl, Disabled } = wp.components;
	const ServerSideRender = wp.serverSideRender;
	const { __ } = wp.i18n;

	registerBlockType( 'agc/quote-form', {
		edit( { attributes, setAttributes } ) {
			return el(
				'div',
				useBlockProps(),
				el(
					InspectorControls,
					null,
					el(
						PanelBody,
						{ title: __( 'Form', 'auto-glass-care' ) },
						el( ToggleControl, { label: __( 'Vehicle make / model / year', 'auto-glass-care' ), checked: attributes.showVehicle, onChange: ( showVehicle ) => setAttributes( { showVehicle } ), __nextHasNoMarginBottom: true } ),
						el( ToggleControl, { label: __( 'Message field', 'auto-glass-care' ), checked: attributes.showMessage, onChange: ( showMessage ) => setAttributes( { showMessage } ), __nextHasNoMarginBottom: true } ),
						el( TextControl, { label: __( 'Button label', 'auto-glass-care' ), value: attributes.submitLabel, onChange: ( submitLabel ) => setAttributes( { submitLabel } ), __nextHasNoMarginBottom: true } ),
						el( 'p', { className: 'components-base-control__help' }, __( 'Services list, recipient email and success message: Appearance → Theme Settings.', 'auto-glass-care' ) )
					)
				),
				el( Disabled, null, el( ServerSideRender, { block: 'agc/quote-form', attributes, skipBlockSupportAttributes: true } ) )
			);
		},
		save: () => null,
	} );
} )( window.wp );
