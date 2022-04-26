/**
 * Toecaps Dropdown Menu Javascript
 *
 * A function to hide the header and reveal by button click. Mainly for use on
 * landing pages where the main header isn't required.
 * 
 * @package Toecaps
 * @author Jefferson Real <me@jeffersonreal.uk>
 * @copyright Copyright (c) 2022, Jefferson Real
 */

var dropdownPlugin = (function() {

    // Private Functions.

    /**
     * Attach event listener to buttons in the loaded doc.
     */
    function initDropdownButtons() {

        let buttons = document.getElementsByClassName( 'dropdown_toggle' );

        [ ...buttons ].forEach( button => {

            button.addEventListener( 'click', buttonClicked = function() {
				dropdownPlugin.toggle( this );
            } );

			button.parentElement.addEventListener( 'mouseenter', dropdownHoverOn = function() {
				// If dropdown is already active, do nothing.
				if ( 'true' === button.getAttribute( "aria-expanded" ) ) return;
				// Otherwise, show the dropdown.
				dropdownPlugin.toggle( this.querySelector('button') );
			} );

			button.parentElement.addEventListener( 'mouseleave', dropdownHoverOff = function() {
				// If dropdown is already inactive, do nothing.
				if ( 'false' === button.getAttribute( "aria-expanded" ) ) return;
				// Otherwise, close the dropdown.
				dropdownPlugin.close( this.querySelector('button') );

			} );
        });
    }

    /**
     * Call init function on document ready.
     */
    let docLoaded = setInterval( function() {

        if( document.readyState === 'complete' ) {
            clearInterval( docLoaded );
            /* Start the reactor */
            initDropdownButtons();
        }
    }, 100);


    /**
     * Check if passed elem is in left half of viewport.
     */
    function isInLeftHalf( button ) {

        const dims = button.getBoundingClientRect();
        viewportWidth = window.innerWidth;

        return (
            dims.left <= viewportWidth / 2
        );
    }


    /**
     * Check if passed elem is overflowing viewport bottom.
     */
    function isOverflowingViewportBottom( menu ) {

        const dims = menu.getBoundingClientRect();
        viewportHeight = window.innerHeight;

        return shouldScroll = {
            bool: dims.bottom > viewportHeight,
            distance: dims.bottom - viewportHeight
        };
    }


    return {

        // Public functions.

        /**
         * Handle off-element click events.
         */
		clickHandler: function( event ) {

			return function checkMyClick( event ) {
				let buttons = document.getElementsByClassName( 'dropdown_toggle' );
		
				[ ...buttons ].forEach( button => {
					if ( button.parentElement !== event.target
						&& ! button.parentElement.contains( event.target ) ) {

						dropdownPlugin.close( button );
						document.removeEventListener( 'click', checkMyClick );
					}
				} );
			}
		},

        /**
         * Toggle the dropdown menu.
         */
		toggle: function( button ) {

            // Get current state of button.
            let aria_exp   = button.getAttribute( "aria-expanded" );

			// Get dropdown element.
			const dropdown = button.parentElement;

            /*  If inactive, make it active */
            if ( 'false' === aria_exp ) {

                //set dropdown swing direction
                let menu = dropdown.lastElementChild;
				let shouldDropRight = isInLeftHalf( dropdown );

                if ( shouldDropRight ) {
                    menu.style.right = '';
                    menu.style.left = '0';
                } else {
                    menu.style.left = '';
                    menu.style.right = '0';
                }

                //set dropdown popop vertical position
                let height = window.getComputedStyle( button ).height;

                menu.style.transform = 'translateY(' + height + ')';

                //set attributes
                button.classList.add( "dropdown_toggle-active" );
                button.setAttribute( "aria-expanded", true );
                button.setAttribute( "aria-pressed", true );

				//now browser has calc'd layout, see if y-scroll req'd
				let shouldScroll = isOverflowingViewportBottom( menu )
				if ( shouldScroll.bool ) {
					window.scrollBy( 0, shouldScroll.distance ); // x,y
				}

				// listen for page clicks.
				document.addEventListener( 'click', dropdownPlugin.clickHandler( event ) );

            } else {

				// Close the dropdown.
                dropdownPlugin.close( button );

				// remove event here fails silently?
				// Issue could be with hovering over child elems?
				//document.removeEventListener( 'click', checkMyClick );
            }
        },

        /**
         * Close the menu.
         */
        close: function( button ) {

            button.classList.remove( "dropdown_toggle-active" );
            button.setAttribute( "aria-expanded", false );
            button.setAttribute( "aria-pressed", false );

			// remove event here doesn't work
			// 'ReferenceError: checkMyClick is not defined'
			//document.removeEventListener( 'click', checkMyClick );
        },


    };/* public functions */
    
})();/* plugin end */