( function ( wp ) {
	const { registerBlockType } = wp.blocks;
	const { createElement: el } = wp.element;
	const { useBlockProps, InspectorControls } = wp.blockEditor;
	const { PanelBody, ToggleControl, Disabled } = wp.components;
	const ServerSideRender = wp.serverSideRender;
	const { __ } = wp.i18n;

	registerBlockType( 'agc/rating-summary', {
		edit( { attributes, setAttributes } ) {
			return el(
				'div',
				useBlockProps(),
				el(
					InspectorControls,
					null,
					el(
						PanelBody,
						{ title: __( 'Rating', 'auto-glass-care' ) },
						el( ToggleControl, {
							label: __( 'Link review count to reviews page', 'auto-glass-care' ),
							checked: attributes.showLink,
							onChange: ( showLink ) => setAttributes( { showLink } ),
							__nextHasNoMarginBottom: true,
						} ),
						el( 'p', { className: 'components-base-control__help' }, __( 'Rating, review count and link: Appearance → Theme Settings → Reviews & financing.', 'auto-glass-care' ) )
					)
				),
				el( Disabled, null, el( ServerSideRender, { block: 'agc/rating-summary', attributes, skipBlockSupportAttributes: true } ) )
			);
		},
		save: () => null,
	} );
} )( window.wp );
