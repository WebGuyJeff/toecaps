/**
 * Toecaps Dropdown Menu Handler.
 *
 * Handles all functionality associated with opening and closing dropdown components.
 * 
 * @package Toecaps
 * @author Jefferson Real <me@jeffersonreal.uk>
 * @copyright Copyright (c) 2022, Jefferson Real
 */

const dropdownPlugin = (function() {
	"use strict";

	// Settings.
	const classNameMenu = 'mainMenu';

    /**
     * Initialise the dropdowns with event listeners.
     */
    function initDropdowns() {

		// Attach 'click' event handler to page.
		document.addEventListener('click', dropdownPlugin.pageClickHandler );

		// Attach 'mouseenter' and 'mouseleave' event handlers to dropdown(s).
		let hoverDropdowns = document.querySelectorAll( '.dropdown-hover:not( .fullscreenMenu .dropdown )' );
		[ ...hoverDropdowns ].forEach( dropdown => {
			dropdownPlugin.registerHover( dropdown );
        } );

		// Attach 'click' event handler to the menu container(s).
        let menus = document.getElementsByClassName( classNameMenu );
        [ ...menus ].forEach( menu => {
            menu.addEventListener( 'click', dropdownPlugin.menuClickHandler );
        } );
    }


    /**
     * Call init function on document ready.
     */
    let docLoaded = setInterval( function() {

        if( document.readyState === 'complete' ) {
            clearInterval( docLoaded );
            initDropdowns();
        }
    }, 100);


    /**
     * Check if passed elem is in left half of viewport.
     */
    function isInLeftHalf( button ) {
        const dims = button.getBoundingClientRect();
        const viewportWidth = window.innerWidth;

        return (
            dims.left <= viewportWidth / 2
        );
    }


    /**
     * Check if passed elem is overflowing viewport bottom and scroll window if needed.
     */
    function scrollIntoView( menu ) {
        const menuStyles     = menu.getBoundingClientRect();
		const bodyStyles     = document.body.getBoundingClientRect();
        const viewportHeight = window.innerHeight;

		if ( menuStyles.bottom > viewportHeight ) {
			const scrollDistance = menuStyles.bottom - viewportHeight;
			window.scrollBy( 0, scrollDistance ); // x,y

			if ( menuStyles.bottom > bodyStyles.bottom ) {
				document.body.style.height = document.documentElement.scrollHeight + scrollDistance + 'px';
			}

		} else {
			return false;
		}
    }


    return { //------------------------------------------------------------------- Public functions.


        /**
         * Handle page clicks.
         */
		pageClickHandler: function( event ) {

			// Bail if the click is on a menu.
			if ( true === !! event.target.closest( '.' + classNameMenu ) ) return;

			// Get all active top-level dropdowns.
			const activeDropdowns = [];
			document.querySelectorAll( '.dropdown-hover' ).forEach( dropdown => {
				if ( dropdown.contains( dropdown.querySelector( '.dropdown_toggle-active' ) ) ) {
					activeDropdowns.push( dropdown );
				}
			} );

			// Close all active top-level dropdowns.
			[ ...activeDropdowns ].forEach( dropdown => {
				if ( true === !! dropdown.closest( '[data-hover-lock="true"]' ) ) {
					dropdown.closest( '.dropdown-hover' ).setAttribute( 'data-hover-lock', 'false');
				}
				dropdownPlugin.close( dropdown.querySelector( '.dropdown_toggle' ) );
			} );
		},


		/**
		 * Dropdown Hover Event Handler.
		 * 
		 * This function should be passed with event listeners.
		 */
		hoverHandler: function( event ) {

			// event.target returns null when assigned to a var!

			const button = event.target.querySelector( '.dropdown_toggle' );
			if ( event.type === 'mouseenter' ) {

/*
When hover enter is disabled, the first close problem goes away.
*/

				// Set focus on the dropdown and open it.
				button.focus();
				dropdownPlugin.open( button );

			} else if ( event.type === 'mouseleave' ) {


				const elemUnderCursor = document.elementFromPoint( event.clientX, event.clientY);
console.log( 'TRUTH ' + ( elemUnderCursor.parentElement.contains( button ) ) );
				if ( elemUnderCursor.parentElement.contains( button ) ) return;

				// If this menu branch isn't hover-locked.
//				if ( false === !! button.closest( '[data-hover-lock="true"]' ) ) {
//					// close it.
//					dropdownPlugin.close( button );
//				}

			}

		},


		/**
		 * Register hover event listeners.
		 * 
		 * Attach hover event listeners to a dropdown element.
		 */
		registerHover: function( dropdown ) {

			dropdown.addEventListener( 'mouseenter', dropdownPlugin.hoverHandler );
			dropdown.addEventListener( 'mouseleave', dropdownPlugin.hoverHandler );
			dropdown.setAttribute( 'data-hover-listener', 'true' );
		},


		/**
		 * Deregister hover event listeners.
		 * 
		 * Useful for when the hover functionality is no longer required. Does not affect the click
		 * listener which should never be removed.
		 */
		deregisterHover: function( dropdown ) {

			dropdown.removeEventListener( 'mouseenter', dropdownPlugin.hoverHandler );
			dropdown.removeEventListener( 'mouseleave', dropdownPlugin.hoverHandler );
			dropdown.setAttribute( 'data-hover-listener', 'false' );
		},


		/**
		 * Detect clicks anywhere on the menu.
		 * 
		 * Menu branches are locked open as soon as they are clicked anywhere inside. This means
		 * they won't close when the user accidentally hovers-off the menu, but they will close as
		 * soon as a click is detected outside of the menu branch.
		 */
		menuClickHandler: function( event ) {

console.log( 'menuClickHandler' );

			// If click is on a dropdown button (3-way toggle).
			if ( true === !! event.target.closest( '.dropdown_toggle' ) ) {
				const button = event.target.closest( '.dropdown_toggle' );

				// If active and unlocked.
				if ( button.classList.contains('dropdown_toggle-active')
					&& false === !! button.closest( '[data-hover-lock="true"]' ) ) {

					// Lock it.
					button.closest( '.dropdown-hover' ).setAttribute( 'data-hover-lock', 'true' );

				// If active and locked.
				} else if ( button.classList.contains( 'dropdown_toggle-active' )
							&& true === !! button.closest( '[data-hover-lock="true"]' ) ) {

					// If it's the top level dropdown, unlock it.
					if ( button.parentElement.classList.contains( 'dropdown-hover' ) ) {
						button.closest( '.dropdown-hover' ).setAttribute( 'data-hover-lock', 'false');
					}
					// Close it.
					dropdownPlugin.close( button );

				// Else, is not active.
				} else {

					// Lock and open it.
					button.closest( '.dropdown-hover' ).setAttribute( 'data-hover-lock', 'true');
					dropdownPlugin.open( button );

					// Close other open branches in the ancestor dropdown.
					const activeButtons = document.querySelectorAll( '.dropdown_toggle-active' );
					[ ...activeButtons ].forEach( activeButton => {

						// Check this isn't an ancestor of the newly opened dropdown.
						if ( ! activeButton.parentElement.contains( button ) ) {
							// Close.
							dropdownPlugin.close( activeButton );
						}
					} );
				}

			// Click is NOT on a dropdown button, but IS in an UNLOCKED dropdown branch.
			} else if ( false === !! event.target.closest( '[data-hover-lock="true"]' )
						&& true === !! event.target.closest( '.dropdown-hover' ) ) {

				// Lock this menu branch.
				event.target.closest( '.dropdown-hover' ).setAttribute( 'data-hover-lock', 'true');
			}
		},


        /**
         * Open the menu.
         */
		open: function( button ) {

				const dropdown = button.parentElement;

				// Set dropdown swing direction on smaller screens.
				if ( window.innerWidth <= 1024
					&& isInLeftHalf( dropdown ) ) {
					dropdown.classList.add( 'dropdown-swingRight' );
					dropdown.classList.remove( 'dropdown-swingLeft' );
				} else {
					dropdown.classList.add( 'dropdown-swingLeft' );
					dropdown.classList.remove( 'dropdown-swingRight' );
				}

				// Get and close all top-level dropdowns that do not contain this dropdown.
				const activeDropdowns = [];
				document.querySelectorAll( '.dropdown-hover:not( .fullscreenMenu .dropdown )' ).forEach( hoverDropdown => {
					if ( hoverDropdown.contains( hoverDropdown.querySelector( '.dropdown_toggle-active' ) ) ) {
						activeDropdowns.push( hoverDropdown );
					}
				} );
				[ ...activeDropdowns ].forEach( activeDropdown => {

					// If dropdown isn't the target, but is active, close it.
					if ( ! activeDropdown.contains( dropdown ) ) {

						// Remove lock and close.
						activeDropdown.setAttribute( 'data-hover-lock', 'false');
						dropdownPlugin.close( activeDropdown.querySelector( '.dropdown_toggle' ) );
					}
				} );

				// Set attributes.
				button.classList.add( "dropdown_toggle-active" );
				button.setAttribute( "aria-expanded", true );
				button.setAttribute( "aria-pressed", true );

				// Now browser has calculcated layout, adjust y-scroll if required,
				let menu = dropdown.lastElementChild;
				scrollIntoView( menu );
        },

        /**
         * Close the menu.
         */
        close: function( button ) {

			// If the button's dropdown also has active children.
			let activeBranch = button.parentElement.querySelectorAll( '.dropdown_toggle-active' );
			if ( activeBranch.length > 1 ) {
				// Iterate through innermost to outer closing all open in branch.
				for (let i = activeBranch.length -1; i >= 0; i--) {
					activeBranch[ i ].classList.remove( "dropdown_toggle-active" );
					activeBranch[ i ].setAttribute( "aria-expanded", false );
					activeBranch[ i ].setAttribute( "aria-pressed", false );

console.log( 'close child: ' + activeBranch[ i ].parentElement.querySelector( '.dropdown_primary' ).innerText );
				} //);

			} else {
				button.classList.remove( "dropdown_toggle-active" );
				button.setAttribute( "aria-expanded", false );
				button.setAttribute( "aria-pressed", false );


console.log( 'close-single: ' + button.parentElement.querySelector( '.dropdown_primary' ).innerText );

			}




        },


    };// Public functions.
})();// Plugin end.
