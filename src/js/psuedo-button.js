/**
 * Toecaps Psuedo-button Initialiser.
 *
 * Find all psuedo-buttons (non-button element) and make them accessible.
 *
 * @package Toecaps
 * @author Jefferson Real <me@jeffersonreal.uk>
 * @copyright Copyright (c) 2022, Jefferson Real
 */

const psuedoButtons = () => {
	'use strict'

	/**
	 * Initialise the buttons.
	 *
	 * Fired on doc ready to attach event listeners to all psuedo-buttons in the DOM.
	 */
	function initPsuedoButtons() {
		// Get buttons which are not button elements.
		let buttons = document.querySelectorAll( '.button:not( button )' );

		[ ...buttons ].forEach( ( button ) => {
			// Tell assistive tech this is a button.
			button.setAttribute( 'role', 'button' )

			// Add to the tab index.
			button.setAttribute( 'tabindex', '0' )

			// Attach keydown listener for spacebar/enter key accessibility.
			button.addEventListener( 'keydown', ( event ) => {
				if (
					event.key === ' ' ||
					event.key === 'Enter' ||
					event.key === 'Spacebar'
				) {
					event.target.click()
					// Prevent browser scroll on space down (default behaviour in Chrome/Firefox etc).
					event.preventDefault()
				}
			} )
		} )
	}

	/**
	 * Call init function on document ready.
	 *
	 * Polls for document ready state.
	 */
	let docLoaded = setInterval( function () {
		if ( document.readyState === 'complete' ) {
			clearInterval( docLoaded )
			initPsuedoButtons()
		}
	}, 100 )
}

export { psuedoButtons }
