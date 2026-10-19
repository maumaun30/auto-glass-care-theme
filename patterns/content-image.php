<?php
/**
 * Title: Text and image
 * Slug: auto-glass-care/content-image
 * Categories: auto-glass-care, text
 * Keywords: about, content, image, text
 * Viewport Width: 1400
 *
 * @package AutoGlassCare
 */

// phpcs:ignore WordPress.Security.EscapeOutput -- section helpers escape their content.
echo agc_section_content_image(
	__( 'Section Heading', 'auto-glass-care' ),
	array(
		__( 'Explain the service, what makes your shop different, or answer a common question.', 'auto-glass-care' ),
		__( 'Add a second paragraph or remove this one.', 'auto-glass-care' ),
	),
	'service-window-tinting.webp'
);
