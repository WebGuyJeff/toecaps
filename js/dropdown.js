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
            button.addEventListener( 'click', buttonClicked = function(){

				dropdownPlugin.toggle( this );
            });
			button.addEventListener( 'hover', buttonClicked = function(){

				dropdownPlugin.toggle( this );
            });
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
         * Toggle the dropdown menu.
         */
		toggle: function( button ) {

            /*  Get current state of button */
            let aria_exp = button.getAttribute( "aria-expanded" );




// I'm unsure about this code. The scope has confused me. Watch this space.
// #############################################################################

const checkMyClick = ( e, dropdown ) => {

	return ( e, scopedDropdown = dropdown ) => {

		const button = dropdown.querySelector( '.dropdown_toggle' );

		console.log('dropdown');
		console.log(dropdown);
		console.log('e.target');
		console.log(e.target);
		console.log('scopedDropdown');
		console.log(scopedDropdown);

		if ( scopedDropdown !== e.target && ! scopedDropdown.contains( e.target ) ) {

			dropdownPlugin.close( button );
			document.removeEventListener( 'click', checkMyClick() );

		}
	};
};

// #############################################################################






            /*  If inactive, make it active */
            if ( aria_exp == "false" ) {

                //set dropdown swing direction
                const dropdown = button.parentElement;
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
				document.addEventListener( 'click', checkMyClick( event, dropdown ) );

            // Else, make it inactive.
            } else {
                dropdownPlugin.close( button );
            }
        },

        /**
         * Close the menu.
         */
        close: function( button ) {

            button.classList.remove( "dropdown_toggle-active" );
            button.setAttribute( "aria-expanded", false );
            button.setAttribute( "aria-pressed", false );
        },

        /**
         * Check if the click event was outside of the menu element.
         * 
         * Preserves the variable values for event listeners. If vars are
         * not passed with the returned function, the event listeners
         * access the function scope at time of event, capturing the wrong
         * values, or none at all.
         */
		pageClick: function( e, dropdown ) {
            // Vars here are NOT passed to event listener.

console.log('e1');
console.log(e);
console.log('dropdown1');
console.log(dropdown);

            return scopePreserver = ( e ) => {
                // Vars here ARE passed to event listener.

console.log('e2');
console.log(e);
console.log('dropdown2');
console.log(dropdown);

const scopedDropdown = dropdown;
const scopedButton = dropdown.querySelector( '.dropdown_toggle' );

				// If click was not on menu element.
				if ( undefined !== e.target ) {
					if ( scopedDropdown !== e.target && ! scopedDropdown.contains( e.target ) ) {

						dropdownPlugin.close( scopedButton );
						document.removeEventListener( 'click', scopePreserver() );

					}
				}

			};
        }


    };/* public functions */
    
})();/* plugin end */