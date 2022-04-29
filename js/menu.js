/**
 * Toecaps Fullscreen Menu Javascript.
 *
 * Functions to handle UX menu features such as disabling body scroll while the fullscreen menu is
 * open. The fullscreen menu is enabled for smaller screens.
 *
 * @package Toecaps
 * @author Jefferson Real <me@jeffersonreal.uk>
 * @copyright Copyright (c) 2022, Jefferson Real
 */


 const menuPlugin = (function() {

	/**
	 * Grab the menu checkbox (should only ever be one instance).
	 */
	const checkbox = document.querySelector( '#fullscreenMenu_toggle' );

	/**
	 * Init the menu with a checkbox 'change' event listener and a window
	 * resize event listener.
	 */
    function initMenu() {

		checkbox.addEventListener( 'change', function() {

			if ( this.checked ) {
				disableScroll();
			} else {
				enableScroll();
			}
		} );
    };


	/**
	 * Windows resize event listener.
	 * 
	 * Toggle the menu checkbox and re-enable body scroll in case the viewport is rezised beyond
	 * 768px while the menu is open. Otherwise, the fullscreen menu would revert to desktop mode but
	 * the scroll would remain disabled. Also, once the viewport was resized to less than 768px
	 * again, the fullscreen menu would unexpectedly appear without the user clicking the menu
	 * button again.
	 */
	const viewportSizeCheck = ( event ) => {

		let viewportResizeSettle = window.setTimeout( () => {

				let pageWidth = parseInt( document.querySelector("html").getBoundingClientRect().width, 10 );
				if ( pageWidth >= 768 && checkbox.checked ) {
					window.clearTimeout( viewportResizeSettle );
					checkbox.click();
					return;
				}

		}, 500 ); // Poll interval.
	};

	/**
	 * Get the scrollbar width.
	 *
	 * Works by getting the difference between the viewport width and the html element width.
	 *
	 * @returns {string} scrollbarWidth The pixel width of the scrollbar.
	 */
	const getScrollbarWidth = () => {

		// Get window width inc scrollbar
		const widthWithScrollBar = window.innerWidth;

		// Get window width exc scrollbar
		const widthWithoutScrollBar = document.querySelector( "html" ).getBoundingClientRect().width;

		// Calc the scrollbar width
		scrollbarWidth = parseInt( ( widthWithScrollBar - widthWithoutScrollBar ), 10 ) + 'px';
		return scrollbarWidth;
	}

	/**
	 * Disable scroll.
	 * 
	 * Sets 'overflow: hidden' on the body element and inserts a div element to fill the gap left
	 * by the missing scrollbar.
	 */
	function disableScroll() {

		// Cover the missing scrollbar gap with a black div
		let elemExists = document.getElementById( "js_psuedoScrollBar" );

		if ( elemExists !== null ) {
			document.getElementById( "js_psuedoScrollBar" ).style.display = 'block';

		} else {
			let psuedoScrollBar = document.createElement( "div" );
			psuedoScrollBar.setAttribute( "id", "js_psuedoScrollBar" );
			psuedoScrollBar.style.position = 'fixed';
			psuedoScrollBar.style.right = '0';
			psuedoScrollBar.style.top = '0';
			psuedoScrollBar.style.width = getScrollbarWidth();
			psuedoScrollBar.style.height = '100vh';
			psuedoScrollBar.style.background = '#333';
			psuedoScrollBar.style.zIndex = '9';
			document.body.appendChild( psuedoScrollBar );
		}

		document.querySelector( "body" ).style.overflow = 'hidden';
		document.querySelector( "html" ).style.paddingRight = scrollbarWidth;

		window.addEventListener( 'resize', viewportSizeCheck );
	}

	/**
	 * Enable scroll.
	 * 
	 * Sets 'overflow: auto' on the body element and removes the div element used to cover the
	 * missing scrollbar.
	 */
	function enableScroll() {

		let elemExists = document.getElementById( "js_psuedoScrollBar" );

		if ( elemExists !== null ) {
			document.getElementById("js_psuedoScrollBar").style.display = 'none';
			document.querySelector("body").style.overflow = 'auto';
			document.querySelector("html").style.paddingRight = '0';
		}

		window.removeEventListener( 'resize', viewportSizeCheck );
	}


	// Poll for doc ready state
	let docLoaded = setInterval( function() {

		if( document.readyState === 'complete' ) {
			clearInterval( docLoaded );
			initMenu();
		}

	}, 100);


})();// plugin end.