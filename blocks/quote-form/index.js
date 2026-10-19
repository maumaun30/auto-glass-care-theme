( function ( wp ) {
	const { registerBlockType } = wp.blocks;
	const { createElement: el } = wp.element;
	const { useBlockProps, InspectorControls } = wp.blockEditor;
	const { PanelBody, TextControl, TextareaControl, ToggleControl, SelectControl, Disabled } = wp.components;
	const ServerSideRender = wp.serverSideRender;
	const { __ } = wp.i18n;

	registerBlockType( 'agc/quote-form', {
		edit( { attributes, setAttributes } ) {
			const isQuote = attributes.variant !== 'contact';
			const set = ( key ) => ( value ) => setAttributes( { [ key ]: value } );

			const quoteControls = isQuote && [
				el( TextareaControl, {
					key: 'services',
					label: __( 'Services (one per line)', 'auto-glass-care' ),
					help: __( 'Leave empty to use the list from Appearance → Theme Settings.', 'auto-glass-care' ),
					value: attributes.services,
					onChange: set( 'services' ),
					__nextHasNoMarginBottom: true,
				} ),
				el( TextControl, { key: 'serviceLabel', label: __( 'Service field label', 'auto-glass-care' ), value: attributes.serviceLabel, onChange: set( 'serviceLabel' ), __nextHasNoMarginBottom: true } ),
				el( SelectControl, {
					key: 'vehicle',
					label: __( 'Vehicle fields', 'auto-glass-care' ),
					value: attributes.vehicle,
					options: [
						{ value: 'split', label: __( 'Make / Model / Year', 'auto-glass-care' ) },
						{ value: 'single', label: __( 'One field', 'auto-glass-care' ) },
						{ value: 'none', label: __( 'None', 'auto-glass-care' ) },
					],
					onChange: set( 'vehicle' ),
					__nextHasNoMarginBottom: true,
				} ),
				el( TextControl, {
					key: 'contactMethods',
					label: __( 'Contact methods (comma separated)', 'auto-glass-care' ),
					help: __( 'Leave empty to hide the question.', 'auto-glass-care' ),
					value: attributes.contactMethods,
					onChange: set( 'contactMethods' ),
					__nextHasNoMarginBottom: true,
				} ),
				el( ToggleControl, { key: 'showMessage', label: __( 'Message field', 'auto-glass-care' ), checked: attributes.showMessage, onChange: set( 'showMessage' ), __nextHasNoMarginBottom: true } ),
				el( ToggleControl, { key: 'showConsent', label: __( 'SMS consent checkbox', 'auto-glass-care' ), checked: attributes.showConsent, onChange: set( 'showConsent' ), __nextHasNoMarginBottom: true } ),
				attributes.showConsent &&
					el( TextareaControl, { key: 'consentText', label: __( 'Consent text', 'auto-glass-care' ), value: attributes.consentText, onChange: set( 'consentText' ), __nextHasNoMarginBottom: true } ),
			];

			return el(
				'div',
				useBlockProps(),
				el(
					InspectorControls,
					null,
					el(
						PanelBody,
						{ title: __( 'Form', 'auto-glass-care' ) },
						el( SelectControl, {
							label: __( 'Form type', 'auto-glass-care' ),
							value: attributes.variant,
							options: [
								{ value: 'quote', label: __( 'Quote request', 'auto-glass-care' ) },
								{ value: 'contact', label: __( 'Contact (name, email, subject, message)', 'auto-glass-care' ) },
							],
							onChange: set( 'variant' ),
							__nextHasNoMarginBottom: true,
						} ),
						quoteControls,
						el( TextControl, { label: __( 'Button label', 'auto-glass-care' ), value: attributes.submitLabel, onChange: set( 'submitLabel' ), __nextHasNoMarginBottom: true } ),
						el( 'p', { className: 'components-base-control__help' }, __( 'Recipient email and success message: Appearance → Theme Settings.', 'auto-glass-care' ) )
					)
				),
				el( Disabled, null, el( ServerSideRender, { block: 'agc/quote-form', attributes, skipBlockSupportAttributes: true } ) )
			);
		},
		save: () => null,
	} );
} )( window.wp );
