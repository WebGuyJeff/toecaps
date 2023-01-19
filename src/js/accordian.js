/**
 * Toecaps Accordian Module.
 *
 * Toggles the ARIA attributes on accordian toggle buttons.
 *
 * @package Toecaps
 * @author Jefferson Real <me@jeffersonreal.uk>
 * @copyright Copyright (c) 2022, Jefferson Real
 */

const accordianButtons = [
	...document.querySelectorAll( 'button.accordian_title' ),
]

const accordian = {
	bindEvents: () =>
		accordianButtons.forEach( ( element ) =>
			element.addEventListener( 'click', function () {
				accordian.toggleAria( this )
			} )
		),

	toggleAria: ( accordian ) => {
		accordian.setAttribute(
			'aria-expanded',
			accordian.getAttribute( 'aria-expanded' ) === 'true'
				? 'false'
				: 'true'
		)
		accordian.setAttribute(
			'aria-pressed',
			accordian.getAttribute( 'aria-pressed' ) === 'true' ? 'false' : 'true'
		)
		// Toggle the checkbox toggle.
		accordian.nextElementSibling.click()
	},

	initialise: () => {
		const docLoaded = setInterval( function () {
			if ( document.readyState === 'complete' ) {
				clearInterval( docLoaded )
				accordian.bindEvents()
			}
		}, 100 )
	},
}

export { accordian }
