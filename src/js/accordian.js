/**
 * Toecaps Accordian Module.
 *
 * Toggles the ARIA attributes on accordian toggle buttons.
 *
 * @package Toecaps
 * @author Jefferson Real <me@jeffersonreal.uk>
 * @copyright Copyright (c) 2022, Jefferson Real
 */

const accordianButtons = [ ...document.querySelectorAll( 'button.accordian_title' ) ];

const accordian = {

	/**
	 * Bind click listeners to accordian buttons.
	 */
	bindEvents: () => accordianButtons.forEach ( element => element.addEventListener(
		'click',
		function () {
			accordian.toggleAria( this )
		}
	) ),

	/**
	 * Toggle ARIA attributes callback.
	 */
	toggleAria: function( accordian ) {
		accordian.setAttribute( 'aria-expanded', accordian.getAttribute( 'aria-expanded' ) === 'true' ? 'false' : 'true' );
		accordian.setAttribute( 'aria-pressed', accordian.getAttribute( 'aria-pressed' ) === 'true' ? 'false' : 'true' );
		// Toggle the checkbox toggle.
		accordian.nextElementSibling.click();
	},

	/**
	 * Initialise on doc ready.
	 */
	initialise: () => {
		const docLoaded = setInterval( function () {
			if ( document.readyState === 'complete' ) {
				clearInterval( docLoaded );
				accordian.bindEvents();
			}
		}, 100 );
	},
}

export { accordian };