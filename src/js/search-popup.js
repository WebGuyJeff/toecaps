/**
 * Toecaps Search Popup.
 *
 * This attaches an event litener to the search button which toggles the search popup.
 *
 * @package Toecaps
 * @author Jefferson Real <me@jeffersonreal.uk>
 * @copyright Copyright (c) 2022, Jefferson Real
 */

const searchPopup = () => {
	/**
	 * Grab the button which opens the search form (should only ever be one instance).
	 */
	const button = document.querySelector( '.search_button' )

	/**
	 * Initialise the button.
	 *
	 * Attach a click event listener to the button which toggles the search form.
	 */
	function initialise() {
		button.addEventListener( 'click', () => {
			document.querySelector( '.search_toggle' ).click()
		} )
	}

	// Poll for doc ready state
	let docLoaded = setInterval( function () {
		if ( document.readyState === 'complete' ) {
			clearInterval( docLoaded )
			initialise()
		}
	}, 100 )
}

export { searchPopup }
