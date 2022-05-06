/**
 * Automatic 'More' for Nav Bars.
 *
 * This plugin detects when a menu bar is outgrowing it's container, and moves as many
 * menu items as neccessary into an appended dropdown to make it fit.
 */
const navAutoMore = (function() {
	'use strict';
	
	// Settings.
	const navSelector     = '.mainMenu:not( .fullscreenMenu .mainMenu )';
	const moreTemplate    = document.querySelector( '.autoMoreTemplate' );
	const minWindowLimit  = 768;
	const classTopLevel   = 'dropdown-hover';
	const classInMenu     = 'dropdown-inMenu';
	
	let initialised  = false;
	let containers   = [];

	// Get all in-page nav bars.
	const navBars = document.querySelectorAll( navSelector );
	// Bail if there are no menus in page.
	if ( navBars.length === 0 ) return;
	// Get all the parent containers.
	navBars.forEach( nav => {
		containers.push( nav.parentElement );
	} );

	/**
	 * Swap classes on an element.
	 * 
	 * The array must contain exactly two classes 
	 */
	const updateClasses = ( elem ) => {

		if ( elem.classList.contains( classInMenu ) ) {
			elem.classList.replace( classInMenu, classTopLevel );
		} else if ( elem.classList.contains( classTopLevel ) ) {
			elem.classList.replace( classTopLevel, classInMenu );
		}
	}
		
	/**
	 * Get element inner width (without padding or borders).
	 */
	const getInnerWidth = ( element ) => {
		const widthIncPadding = element.clientWidth;
		const styles          = window.getComputedStyle( element );
		const paddingLeft     = parseInt( styles.getPropertyValue('padding-left' ), 10);
		const paddingRight    = parseInt( styles.getPropertyValue( 'padding-right' ), 10);
		const innerWidth      = widthIncPadding - ( paddingLeft + paddingRight );
		return innerWidth;
	}

	/**
	 * Update all Nav Bars.
	 */
	const updateAll = () => {
		containers.forEach( container => {
			const nav          = container.querySelector( navSelector );
			const more         = nav.querySelector( '.autoMore' );
			const moreContents = more.querySelector( '.autoMore > .dropdown_contents' );
			update( container, nav, more, moreContents );
		} );
	}

	/**
	 * Update the 'more' element.
	 */
	const update = ( container, nav, more, moreContents ) => {
		
		let containerWidth = getInnerWidth( container );
		let navWidth       = nav.offsetWidth;

		// Bail if the menu is empty/hidden.
		if ( navWidth <= 0 ) return;

		const navGap  = parseInt( window.getComputedStyle( nav ).getPropertyValue("gap"), 10); // Flex Gap.
		// let moreWidth = more.offsetWidth + navGap;

		if ( window.innerWidth >= minWindowLimit ) {

			if ( navWidth > containerWidth ) {

				// While the nav width is too big.
				let navLastItem;
				while ( navWidth > containerWidth ) {
					// Move last menu item to 'more'.
					let count = nav.children.length;
					navLastItem = nav.children[ count - 2 ] // Don't select the 'more' item.
					moreContents.prepend( navLastItem );
					navWidth = nav.offsetWidth;

					// Update classes if needed.
					updateClasses( navLastItem );

					// Deregister hover event listeners.
					if ( navLastItem.classList.contains( classInMenu ) ) {
						dropdownPlugin.deregisterHover( navLastItem );
					}
				}

			} else if ( moreContents.children.length > 0 ) {

				// While nav width is smaller than container.
				let moreFirstItem      = moreContents.firstElementChild;
				let moreFirstItemWidth = moreFirstItem.offsetWidth;
				let newNavWidth        = navWidth + moreFirstItemWidth + navGap;		
				while ( newNavWidth < containerWidth &&
						moreContents.children.length > 0 ) {

					// Put a menu item back if it fits.
					nav.insertBefore( moreFirstItem, more );

					// Update classes if needed.
					updateClasses( moreFirstItem );

					// Register hover event listeners.
					if ( moreFirstItem.classList.contains( classTopLevel ) ) {
						dropdownPlugin.registerHover( moreFirstItem );
					}
					
					// Calc the nav width with the next element.
					moreFirstItem      = moreContents.firstElementChild;
					moreFirstItemWidth = moreFirstItem.offsetWidth;
					navWidth           = nav.offsetWidth;
					newNavWidth        = navWidth + moreFirstItemWidth + navGap;
				}
			}

			if ( moreContents.childElementCount > 0 ) {
				more.style.position = 'relative';
				more.style.visibility = 'visible';
			} else {
				more.style.position = 'absolute';
				more.style.visibility = 'hidden';
			}
		}
	}

	/**
	 * Initialise the plugin.
	 */
	const init = () => {
		if ( initialised ) return;
		initialised = true;
		
		// Add the 'more' element to all the navs.
		containers.forEach( container => {
			const moreClone = moreTemplate.content.cloneNode( true );
			const nav       = container.querySelector( navSelector );

			nav.appendChild( moreClone );
			const autoMore = nav.querySelector( '.autoMore' );

			// Attach dropdown hover event listeners.
			dropdownPlugin.registerHover( autoMore );

			// Attach keydown listener to psuedo-button for spacebar/enter key accessibility.
			autoMore.firstElementChild.addEventListener("keydown", event => {
				if (event.key === " " || event.key === "Enter" || event.key === "Spacebar") {
					event.target.click();
					// Prevent browser scroll on space down (default behaviour in Chrome/Firefox etc).
					event.preventDefault();
				}
			} );

		} );
		
		// Process the nav items.
		updateAll();
	}
	
	/**
	 * Throttled window resize trigger.
	 */
	let resizeTimout;
	window.onresize = function() {
		clearTimeout( resizeTimout );
		if ( ! initialised ) return;

		resizeTimout = setTimeout( updateAll, 30 );
	};
	
	/**
	 * Initialise after page load.
	 */
	let docLoaded = setInterval( function() {
		if( document.readyState === 'complete') {
			clearInterval( docLoaded );

			init();
		}
	}, 50);

})();
