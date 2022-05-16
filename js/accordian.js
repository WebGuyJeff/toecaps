/**
 * Toecaps Accordian Menu Handler.
 *
 * Toggles the ARIA attributes on accordian toggle buttons.
 *
 * @package Toecaps
 * @author Jefferson Real <me@jeffersonreal.uk>
 * @copyright Copyright (c) 2022, Jefferson Real
 */

const accordianPlugin = (function () {
	'use strict';


	return {
		//------------------------------------------------------------------- Public functions.

		/**
		 * Toggle ARIA attributes.
		 *
		 * @param {Event} event - The event object.
		 */
		toggleAria: function ( accordian ) {
			accordian.setAttribute( 'aria-expanded', accordian.getAttribute( 'aria-expanded' ) === 'true' ? 'false' : 'true' );
			accordian.setAttribute( 'aria-pressed', accordian.getAttribute( 'aria-pressed' ) === 'true' ? 'false' : 'true' );
		},

	}; // Public functions.
})(); // Plugin end.
