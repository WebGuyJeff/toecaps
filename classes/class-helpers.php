<?php
/**
 * A library of helper functions for WordPress.
 *
 * @package   Toecaps
 * @author    Jefferson Real <me@jeffersonreal.uk>
 * @copyright Copyright (c) 2022, Jefferson Real
 */

namespace BigupWeb\Toecaps;

/**
 * A library of misc helpers for WordPress.
 */
class Helpers {


	/**
	 * Public method: enqueue_assets()
	 *
	 * Register assets passed as an argument using enqueue_assets() as a cb.
	 * Not intended for production use as is.
	 *
	 * @param fonts array of fonts to enqueue
	 */
	public static function enqueue_assets( ...$fonts ) {

		$asset_handles = array();

		if ( ! isset( $fonts ) ) {
			echo '<script>console.error("ERROR: Bigupweb\Toecaps\Helpers:enqueue_assets() FONT ARGS EMPTY")</script>';

		} else {

			$match = false;

			foreach ( $fonts as $font_name ) {
				switch ( $font_name ) {

					case 'jetbrains':
						wp_register_style( 'jetbrains', 'https://fonts.googleapis.com/css2?family=JetBrains+Mono&display=swap', false );
						$asset_handles[] = 'jetbrains';
						$match           = true;
						break;

					default:
						echo '<script>console.error("ERROR: BigupWeb\\\Toecaps\\\Helpers:enqueue_assets() FONT NOT FOUND: ' . $font_name . '")</script>';
						break;
				}
			}

			if ( $match ) {

				foreach ( $asset_handles as $handle ) {
					wp_enqueue_style( $handle );
				}
			}
		}
	}

	/**
	 * Public method: output_to_front_end(  )
	 *
	 * Print anything to the front end. Useful for quickly outputting variables or function
	 * results when debugging/experimenting. 🧪
	 *
	 * Front end handled in js to account for mutlple calls to this function trying to create the
	 * same element. Further outputs will be appended to the existing #toecaps_debug_console.
	 */
	public static function output_to_front_end( $dump ) {

		self::enqueue_assets( 'jetbrains' );

		$parent  = '<div id="toecaps_debug_console" style="z-index: 999; position: fixed; bottom: 0px; left: 0px; right: 0px; width: 100%; height: 20%; border: 1px solid; resize: both; overflow: auto; white-space: pre; background: rgb(255, 255, 255); color: rgb(0, 0, 0); box-shadow: rgba(0, 0, 0, 0.4) 0px -1px 6px 2px;">';
		$parent .= '<b style="font-size:0.85em;background:#333;color:#fff;margin: 0;display: block;width: fit-content;border-bottom-right-radius: 0.4em;"> Your output is served 👨‍🍳 </b>';
		$parent .= '<button onclick="this.parentElement.remove()" style="border:none;outline:none;font-size:0.85em;font-weight:700;background:#333;color:#fff;margin: 0;padding: 0;display: block;position:absolute;top:0;right:0;margin-left:auto;width: fit-content;border-bottom-left-radius: 0.4em;"> Close ❌ </button>';
		$parent .= '</div>';
		$parent .= $parent;

		$el_open = '<pre style="margin: 0; font: 0.7rem \\\'JetBrains Mono\\\', monospace; white-space: pre-wrap; border-bottom: dashed 1px #999;">';

		if ( is_null( $dump ) ) {
			$el_content = 'NULL';
		} elseif ( is_array( $dump ) || is_object( $dump ) ) {
			$el_content = htmlspecialchars( print_r( $dump, true ) );
		} else {
			$el_content = $dump;
		}

		// foreach ( $dump as $key => $value ) {
		// htmlspecialchars( var_dump( $value ) );
		// }

		$el_close = '</pre>';
		$output   = $el_open . $el_content . $el_close;

		echo $output;

		/*
		echo <<<HTML
		<script>
		console.log('{$output}');
		document.addEventListener('DOMContentLoaded', ( event ) => {
		if ( ! document.getElementById("toecaps_debug_console") ) {
		document.body.insertAdjacentHTML( "beforeend", '{$parent}' );
		}
		document.getElementById("toecaps_debug_console").insertAdjacentHTML( "beforeend", '{$output}' );
		} )
		</script>
		HTML;
		*/
	}


	/**
	 * Unregister unused nav menu locations.
	 *
	 * Unregister all unused nav menu locations that were registered by a theme and not currently
	 * in use. Any menu locations which are actively being registered e.g. in functions.php will remain
	 * so. Output displayed on front end. Warning: this function is destructive.
	 *
	 * @param {Boolean} update_db: True = writes changes to DB, False = dry run with output.
	 */
	public static function unregister_unused_nav_menu_locations( $update_db = false ) {

		echo '<div style="position:fixed;top:0;left:0;max-width:100vw;max-height:100vh;overflow:auto;white-space:pre;background:#fff;color:#000;">';

		$menus              = get_registered_nav_menus();
		$locations          = get_nav_menu_locations();
		$orphaned_locations = array();
		$current_locations  = array();

		// For each location...
		foreach ( $locations as $loc_key => $loc_value ) {

			$match = false;

			// ...check for a matching nav menu registration
			foreach ( $menus as $men_key => $men_value ) {

				if ( $men_key == $loc_key ) {
					$match = true;
				}
			}
			// add to this array if not matched...
			if ( $match === false ) {
				$orphaned_locations[ $loc_key ] = $loc_value;

				// ...else add to this array
			} else {
				$current_locations[ $loc_key ] = $loc_value;
			}
		}

		// Start the Output
		echo '<pre>';

		// if update_db is true, attempt deletion of orphans and output results...
		if ( $update_db ) {

			echo 'Old Menu Locations <br><br>';
			var_dump( get_nav_menu_locations() );

			// set the database option and capture boolean result...
			$has_updated = set_theme_mod( 'nav_menu_locations', $current_locations );

			// ...success
			if ( $has_updated ) {
				echo '<br>SUCCESS: Menu locations updated.<br>';
				echo '<br>Deleted Locations: <br><br>';
				var_dump( $orphaned_locations );
				// ...fail
			} else {
				echo '<br>ERROR: set_theme_mod failed to update value.<br>';
				echo '<br>Perhaps there were no orphaned menus?<br>';
			}

			// ...else, output a list of orphaned locations but take no action.
		} else {

			echo 'DRY RUN - NO ACTION TAKEN<br><br>';

			echo '$orphaned_locations: <br><br>';
			var_dump( $orphaned_locations );

			echo '<br>$current_locations: <br><br>';
			var_dump( $current_locations );

		}
		echo '</pre></div>';
	}


	/**
	 * Display registered nav menus.
	 *
	 * Display all registered nav menus and locations for debugging/cleanup. Registered nav menus
	 * are menus which have been registered to a location, but are not necessarily a current menu.
	 * I'm not aware of a need to keep these in the db and ideally should be purged.
	 *
	 * Use unregister_unused_nav_menu_locations() to cleanup the orphans.
	 *
	 * Output displayed on front end.
	 */
	public static function display_all_registered_nav_menu_objects() {

		echo '<div style="position:fixed;top:0;left:0;max-width:100vw;max-height:100vh;overflow:auto;white-space:pre;background:#fff;color:#000;">';
		echo '<pre>';

		echo '<br>';
		echo 'Registered nav menu locations';
		echo '<br>';
		echo '-----------------------------';
		echo '<br><br>';
		var_dump( get_nav_menu_locations() );
		echo '<br>';

		echo '<br>';
		echo 'Registered nav menu objects';
		echo '<br>';
		echo '---------------------------';
		echo '<br><br>';
		var_dump( get_registered_nav_menus() );
		echo '<br>';

		$locations = get_nav_menu_locations();
		$count     = 0;
		echo '<br>';
		echo 'Location => menu object registrations';
		echo '<br>';
		echo '-------------------------------------';
		echo '<br><br>';
		echo 'KEY:';
		echo '<br>';
		echo '📍 = location';
		echo '<br>';
		echo '📜 = menu name';
		echo '<br><br><br><br>';

		foreach ( $locations as $loc => $value ) {

			$count      = $count + 1;
			$menuobject = wp_get_nav_menu_object( $value );

			echo '---( #' . $count . ' )--';
			echo '<br><br>';

			if ( is_object( $menuobject ) ) {
				$name = $menuobject->name;
				echo '📍  "' . $loc . '"';
				echo '<br>';
				echo '📜  "' . $name . '"';
				echo '<br><br>';

				foreach ( $menuobject as $sub_key => $sub_value ) {
					if ( is_array( $sub_key ) ) {
						var_dump( $menuobject->$sub_key );
						echo '<br>';
					} else {
						echo $sub_key . ' => ' . $sub_value;
						echo '<br>';
					}
				}
			} elseif ( is_array( $menuobject ) ) {
				$name = $menuobject['name'];
				echo '📍  "' . $loc . '"';
				echo '<br>';
				echo '📜  "' . $name;
				echo '<br><br>';

				foreach ( $menuobject as $sub_key => $sub_value ) {
					if ( is_array( $sub_key ) ) {
						var_dump( $menuobject->$sub_key );
						echo '<br>';
					} else {
						echo $sub_key . ' => ' . $sub_value;
						echo '<br>';
					}
				}
			} else {
				echo '📍  "' . $loc . '"';
				echo '<br>';
				if ( $menuobject == '' ) {
					echo '📜  [no menu registered]';
				} else {
					echo 'ERROR: menu object not recognised';
					echo $menuobject;
				}
				echo '<br>';
			}
			echo '<br><br><br>';
		}
		echo '</pre></div>';
	}

	/**
	 * Sanitise phone numbers
	 */
	public static function sanitise_phone_number( $phone ) {

		return preg_replace( '/[^\d+]/', '', $phone );
	}


	/**
	 * Clean a string for CSS class use or similar.
	 *
	 * Removes excess whitespace and invalid characters.
	 *
	 * @param {string} $string A string to be cleaned.
	 * @return {string} A cleaned string.
	 */
	public static function sanitise_classes( $string ) {

		$trimmed_string = trim( $string );
		$safe_string    = preg_replace( '/[^A-Za-z0-9 \-_]/', '', $trimmed_string );

		return $safe_string;
	}


	/**
	 * Get the first sentence of a string
	 *
	 * @param {string} $string The string of text to get the first sentence from.
	 * @return {string} The first sentence of the string.
	 */
	public static function get_first_sentence( $string ) {

		$sentence = preg_split( '/(\.|!|\?)\s/', $string, 2, PREG_SPLIT_DELIM_CAPTURE );
		return $sentence['0'];
	}

	/**
	 * Get the first sentence of a string
	 *
	 * @param  {string} $html The string of html to get the first <p> from.
	 * @return {string} $sentence The first sentence of the <p>.
	 */
	public static function get_first_sentence_of_html( $html ) {
		preg_match( '/<p>(.*?)<\/p>/', $html, $match );
		// Bail if no <p>'s found.
		if ( empty( $match ) ) {
			return;
		}
		$sentence = self::get_first_sentence( $match[1] );
		return $sentence;
	}


}//end class
