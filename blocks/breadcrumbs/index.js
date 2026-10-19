( function ( wp ) {
	const { registerBlockType } = wp.blocks;
	const { createElement: el } = wp.element;
	const { useBlockProps, InspectorControls } = wp.blockEditor;
	const { PanelBody, TextControl, Disabled } = wp.components;
	const ServerSideRender = wp.serverSideRender;
	const { __ } = wp.i18n;

	registerBlockType( 'agc/breadcrumbs', {
		edit( { attributes, setAttributes, context } ) {
			return el(
				'div',
				useBlockProps(),
				el(
					InspectorControls,
					null,
					el(
						PanelBody,
						{ title: __( 'Breadcrumbs', 'auto-glass-care' ) },
						el( TextControl, { label: __( 'Home label', 'auto-glass-care' ), value: attributes.homeLabel, onChange: ( homeLabel ) => setAttributes( { homeLabel } ), __nextHasNoMarginBottom: true } )
					)
				),
				el( Disabled, null, el( ServerSideRender, { block: 'agc/breadcrumbs', attributes, skipBlockSupportAttributes: true, urlQueryArgs: context.postId ? { post_id: context.postId } : {} } ) )
			);
		},
		save: () => null,
	} );
} )( window.wp );
