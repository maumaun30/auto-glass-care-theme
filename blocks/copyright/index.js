( function ( wp ) {
	const { registerBlockType } = wp.blocks;
	const { createElement: el } = wp.element;
	const { useBlockProps, InspectorControls } = wp.blockEditor;
	const { PanelBody, TextControl } = wp.components;
	const ServerSideRender = wp.serverSideRender;
	const { __ } = wp.i18n;

	registerBlockType( 'agc/copyright', {
		edit( { attributes, setAttributes } ) {
			return el(
				'div',
				useBlockProps(),
				el(
					InspectorControls,
					null,
					el(
						PanelBody,
						{ title: __( 'Text', 'auto-glass-care' ) },
						el( TextControl, { label: __( 'Text after business name', 'auto-glass-care' ), value: attributes.suffix, onChange: ( suffix ) => setAttributes( { suffix } ), __nextHasNoMarginBottom: true } )
					)
				),
				el( ServerSideRender, { block: 'agc/copyright', attributes, skipBlockSupportAttributes: true } )
			);
		},
		save: () => null,
	} );
} )( window.wp );
