<?php
/**
 * Toecaps Template File - Searchform.
 *
 * @link https://developer.wordpress.org/reference/functions/wp_unique_id/
 * @link https://developer.wordpress.org/reference/functions/get_search_form/
 *
 * @package   Toecaps
 * @author    Jefferson Real <me@jeffersonreal.uk>
 * @copyright Copyright (c) 2022, Jefferson Real
 */

/**
 * Generate a unique ID for each form and a string containing an aria-label
 * if one was passed to get_search_form() in the args array.
 */
$unique_id = wp_unique_id( 'search-form-' );
$aria_label = ! empty( $args['aria_label'] ) ? 'aria-label="' . esc_attr( $args['aria_label'] ) . '"' : '';
?>
<form
	role="search" <?php echo $aria_label; ?>
	method="get" class="search_form"
	action="<?php echo esc_url( home_url( '/' ) ); ?>"
>
	<label
		for="<?php echo esc_attr( $unique_id ); ?>"
		aria-label="<?php _e( 'Search this website', 'toecaps' ); ?>"
	>
	</label>
	<input
		type="search"
		title="<?php esc_attr( _e( 'Enter a search term', 'toecaps' ) ); ?>"
		id="<?php echo esc_attr( $unique_id ); ?>"
		class="search_field"
		value="<?php echo get_search_query(); ?>"
		name="s"
		placeholder="<?php esc_attr( _e( 'Search', 'toecaps' ) ); ?>"
	/>
	<button
		type="submit"
		title="<?php esc_attr( _e( 'Submit search', 'toecaps' ) ); ?>"
		class="search_submit"
		value="<?php echo esc_attr_x( 'Search', 'submit button', 'toecaps' ); ?>"
	>
		<i class="fa-solid fa-magnifying-glass"></i>
	</button>
</form>
