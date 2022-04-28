/**
 * Automatic 'More' for Nav Bars.
 *
 * This plugin detects when a menu bar is outgrowing it's container, and moves as many
 * menu items as neccessary into an appended dropdown to make it fit.
 */
 const navAutoMore = (function() {
	'use strict';
	
	// Settings.
	const navSelector     = '.mainMenu';
	const navItemSelector = '.mainMenu_item';
	const moreTemplate    = document.querySelector( '.autoMoreTemplate' );
	const minWindowLimit  = 320;
	
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
		
		let childNumber = 2;
		const containerWidth = getInnerWidth( container );
		let   navWidth       = nav.offsetWidth;
		const navGap         = parseInt( window.getComputedStyle( nav ).getPropertyValue("gap"), 10); // Flex Gap.
		const moreWidth      = more.offsetWidth + navGap;

		if ( window.innerWidth >= minWindowLimit ) {
			
			if ( navWidth > containerWidth - moreWidth ) {

				// While the nav width is too big.
				let n = 0;
				let overflowItem;
				while ( navWidth > containerWidth - moreWidth ) {
					n++;
					
					// Move last menu item to 'more'.
					overflowItem = nav.querySelector( `${navItemSelector}:nth-last-child(${childNumber})` );
					moreContents.prepend( overflowItem );
					navWidth = nav.offsetWidth;
				}

			} else if ( moreContents.children.length > 0 ) {
				
				let moreFirstItem      = moreContents.querySelector( `${navItemSelector}:first-child` );
				let moreFirstItemWidth = moreFirstItem.offsetWidth;
				let newNavWidth        = navWidth + moreFirstItemWidth + navGap;
				let n                  = 0;				
				
				// While nav width is smaller than container.
				while ( newNavWidth < containerWidth - moreWidth ) {
					n++;
					
					// Put a menu item back if it fits.
					nav.insertBefore( moreFirstItem, more );
					if ( moreContents.children.length === 0 ) break;
					
					// Calc the nav width with the next element.
					moreFirstItem      = moreContents.querySelector( `${navItemSelector}:first-child` );
					moreFirstItemWidth = moreFirstItem.offsetWidth;
					navWidth           = nav.offsetWidth;
					newNavWidth        = navWidth + moreFirstItemWidth + navGap;
				}
			}
			if ( moreContents.childElementCount > 0 ) {
				more.style.position = 'relative';
				more.style.visibility = 'visible';
				childNumber = 2;
			} else {
				more.style.position = 'absolute';
				more.style.visibility = 'hidden';
				childNumber = 1;
			}
		}
	}
	
	/**
	 * Initialise after page load.
	 */
	let docLoaded = setInterval( function() {
		if( document.readyState === 'complete') {
			clearInterval( docLoaded );
			init();
		}
	}, 50);
	
	/**
	 * Throttle resize event.
	 */
	let resizeTimout;
	window.onresize = function() {
		clearTimeout( resizeTimout );
		
		if ( initialised ) {
			resizeTimout = setTimeout( updateAll, 10 );
		}
	};

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
		} );
		// Process the nav items.
		updateAll();
	}

})();