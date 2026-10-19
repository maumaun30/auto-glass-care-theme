<?php
/**
 * Title: Two-column checklist
 * Slug: auto-glass-care/checklist-columns
 * Categories: auto-glass-care, text
 * Keywords: list, checklist, vehicles
 * Viewport Width: 1400
 *
 * @package AutoGlassCare
 */

// phpcs:ignore WordPress.Security.EscapeOutput -- section helpers escape their content.
echo agc_section_checklist_columns(
	__( 'Vehicles We Service', 'auto-glass-care' ),
	__( 'From daily drivers to weekend toys.', 'auto-glass-care' ),
	array(
		__( 'Cars & Sedans', 'auto-glass-care' ),
		__( 'SUVs & Crossovers', 'auto-glass-care' ),
		__( 'Trucks', 'auto-glass-care' ),
		__( 'Sports & Exotic Cars', 'auto-glass-care' ),
		__( 'Electric Vehicles', 'auto-glass-care' ),
		__( 'Classic Cars', 'auto-glass-care' ),
	)
);
