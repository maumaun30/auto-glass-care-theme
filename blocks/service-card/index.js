( function ( wp ) {
	const { registerBlockType } = wp.blocks;
	const { createElement: el, Fragment } = wp.element;
	const { useBlockProps, InspectorControls, MediaUpload, MediaUploadCheck, URLInput } = wp.blockEditor;
	const { PanelBody, TextControl, TextareaControl, RangeControl, Button, Disabled } = wp.components;
	const ServerSideRender = wp.serverSideRender;
	const { __ } = wp.i18n;

	registerBlockType( 'agc/service-card', {
		edit( { attributes, setAttributes } ) {
			const imagePicker = el(
				MediaUploadCheck,
				null,
				el( MediaUpload, {
					onSelect: ( media ) => setAttributes( { imageId: media.id, imageUrl: media.url } ),
					allowedTypes: [ 'image' ],
					value: attributes.imageId,
					render: ( { open } ) =>
						el(
							Fragment,
							null,
							el( Button, { variant: 'secondary', onClick: open }, attributes.imageUrl ? __( 'Replace image', 'auto-glass-care' ) : __( 'Choose image', 'auto-glass-care' ) ),
							attributes.imageUrl &&
								el( Button, { variant: 'link', isDestructive: true, onClick: () => setAttributes( { imageId: 0, imageUrl: '' } ) }, __( 'Remove', 'auto-glass-care' ) )
						),
				} )
			);

			return el(
				'div',
				useBlockProps(),
				el(
					InspectorControls,
					null,
					el(
						PanelBody,
						{ title: __( 'Card', 'auto-glass-care' ) },
						imagePicker,
						el( TextControl, { label: __( 'Title', 'auto-glass-care' ), value: attributes.title, onChange: ( title ) => setAttributes( { title } ), __nextHasNoMarginBottom: true } ),
						el( TextareaControl, { label: __( 'Description', 'auto-glass-care' ), value: attributes.description, onChange: ( description ) => setAttributes( { description } ), __nextHasNoMarginBottom: true } ),
						el( 'p', null, __( 'Link', 'auto-glass-care' ) ),
						el( URLInput, { value: attributes.linkUrl, onChange: ( linkUrl ) => setAttributes( { linkUrl } ) } ),
						el( TextControl, { label: __( 'Link text', 'auto-glass-care' ), value: attributes.linkText, onChange: ( linkText ) => setAttributes( { linkText } ), __nextHasNoMarginBottom: true } ),
						el( RangeControl, { label: __( 'Height (px)', 'auto-glass-care' ), value: attributes.height, min: 160, max: 600, onChange: ( height ) => setAttributes( { height } ), __nextHasNoMarginBottom: true } )
					)
				),
				el( Disabled, null, el( ServerSideRender, { block: 'agc/service-card', attributes, skipBlockSupportAttributes: true } ) )
			);
		},
		save: () => null,
	} );
} )( window.wp );
