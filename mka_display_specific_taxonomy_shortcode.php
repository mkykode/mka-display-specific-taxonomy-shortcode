<?php
/**
 * Plugin Name: Monkey Kode Display Specific Taxonomy Shortcode
 * Version:     1.0.0
 * Description: Displays a list of Taxonomy term links via a shortcode
 * Author:      Jull Weber
 * Author URI:  https://monkeykode.com/
 * License:     GPL2
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: mka_display_specific_taxonomy_shortcode
 * Domain Path: /languages
 *
 * @package MKA
 */

defined( 'ABSPATH' ) or die( 'No script kiddies please!' );


if ( ! function_exists( 'mka_display_tax_list_shortcode' ) ) {
	/**
	 * Display the html shortcode.
	 */
	function mka_display_tax_list_shortcode() {
		/**
		 * Generate shortcode.
		 *
		 * @param object $atts attributes passed.
		 *
		 * @return string
		 */
		function mka_add_tax_links( $atts ) {
			// Attributes.
			$atts = shortcode_atts(
				array(
					'tax'     => '',
					'orderby' => 'name',
					'order'   => 'ASC',
				),
				$atts
			);
			ob_start();
			global $post;
			$terms = wp_get_post_terms( $post->ID, $atts['tax'], array(
				'orderby' => $atts['orderby'],
				'order'   => $atts['order'],
			) );
			echo '<ul>';
			foreach ( $terms as $term ) {
				echo '<a href="' . esc_url( get_term_link( $term ) ) . '">';
				echo '<li>' . esc_html( $term->name ) . '</li>';
				echo '</a>';

			}
			echo '</ul>';
			return ob_get_clean();

		}

		add_shortcode( 'add_tax_links', 'mka_add_tax_links' );
	}

	mka_display_tax_list_shortcode();
}

