( function ( wp ) {
	const { registerBlockType } = wp.blocks;
	const { createElement: el } = wp.element;
	const { useBlockProps, InspectorControls, PanelColorSettings } = wp.blockEditor;
	const { PanelBody, SelectControl, ToggleControl, Disabled } = wp.components;
	const ServerSideRender = wp.serverSideRender;
	const { __ } = wp.i18n;

	registerBlockType( 'agc/social-links', {
		edit( { attributes, setAttributes } ) {
			return el(
				'div',
				useBlockProps(),
				el(
					InspectorControls,
					null,
					el(
						PanelBody,
						{ title: __( 'Icons', 'auto-glass-care' ) },
						el( SelectControl, {
							label: __( 'Size', 'auto-glass-care' ),
							value: attributes.size,
							options: [
								{ value: 'has-small-icon-size', label: __( 'Small', 'auto-glass-care' ) },
								{ value: 'has-normal-icon-size', label: __( 'Normal', 'auto-glass-care' ) },
								{ value: 'has-large-icon-size', label: __( 'Large', 'auto-glass-care' ) },
								{ value: 'has-huge-icon-size', label: __( 'Huge', 'auto-glass-care' ) },
							],
							onChange: ( size ) => setAttributes( { size } ),
							__nextHasNoMarginBottom: true,
						} ),
						el( ToggleControl, {
							label: __( 'Logos only', 'auto-glass-care' ),
							checked: attributes.logosOnly,
							onChange: ( logosOnly ) => setAttributes( { logosOnly } ),
							__nextHasNoMarginBottom: true,
						} ),
						el( 'p', { className: 'components-base-control__help' }, __( 'Profile URLs are managed in Appearance → Theme Settings.', 'auto-glass-care' ) )
					),
					el( PanelColorSettings, {
						title: __( 'Color', 'auto-glass-care' ),
						colorSettings: [
							{
								label: __( 'Icon color', 'auto-glass-care' ),
								value: attributes.iconColor,
								onChange: ( iconColor ) => setAttributes( { iconColor: iconColor || '' } ),
							},
						],
					} )
				),
				el( Disabled, null, el( ServerSideRender, { block: 'agc/social-links', attributes, skipBlockSupportAttributes: true } ) )
			);
		},
		save: () => null,
	} );
} )( window.wp );
