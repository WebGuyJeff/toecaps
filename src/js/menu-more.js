/**
 * Automatic 'More' for Nav Bars.
 *
 * This plugin detects when a menu bar is outgrowing it's parent element, and moves as many
 * menu items as neccessary into an appended dropdown to make it fit.
 */

import { dropdownControl } from './dropdown.js'

const menuMore = () => {
	'use strict'

	// Settings.
	const navSelector    = '.navBar nav'
	const moreTemplate   = document.querySelector( ".autoMoreTemplate" )
	const minActiveWidth = 768 // Min CSS media query width navbar is shown.
	const inNavbarClass  = 'dropdown-hover'
	const inMoreClass    = 'dropdown-inMenu'

	let initialised = false 
	let navParents  = []

	// Get all in-page nav bars.
	const navBars = document.querySelectorAll( navSelector )
	// Bail if there are no menus in page.
	if ( navBars.length === 0 ) return
	// Get all the parent navParents.
	navBars.forEach( ( nav ) => {
		navParents.push( nav.parentElement )
	} )

	/**
	 * Swap classes on an element.
	 *
	 * The array must contain exactly two classes
	 */
	const updateClasses = ( elem ) => {
		if ( elem.classList.contains( inMoreClass ) ) {
			elem.classList.replace( inMoreClass, inNavbarClass )
		} else if ( elem.classList.contains( inNavbarClass ) ) {
			elem.classList.replace( inNavbarClass, inMoreClass )
		}
	}

	/**
	 * Get element inner width (without padding or borders).
	 */
	const getInnerWidth = ( element ) => {
		const widthIncPadding = element.clientWidth
		const styles          = window.getComputedStyle( element )
		const paddingLeft     = parseInt( styles.getPropertyValue( 'padding-left' ), 10 )
		const paddingRight    = parseInt( styles.getPropertyValue( 'padding-right' ), 10 )
		const innerWidth      = widthIncPadding - ( paddingLeft + paddingRight )
		return innerWidth
	} 

	/**
	 * Update all Nav Bars.
	 */
	const updateAll = () => {
		navParents.forEach( ( navParent ) => {
			const nav          = navParent.querySelector( navSelector )
			const more         = nav.querySelector( '.autoMore' )
			const moreContents = more.querySelector( '.autoMore > .dropdown_contents' )
			update( navParent, nav, more, moreContents )
		} )
	}

	/**
	 * Update the 'more' element.
	 */
	const update = ( navParent, nav, more, moreContents ) => {
		let navParentWidth = getInnerWidth( navParent )
		let navWidth       = nav.offsetWidth
		const flexGap      = parseInt( window.getComputedStyle( nav ).getPropertyValue( 'gap' ), 10 )

		if ( navWidth <= 0 ) return
		if ( window.innerWidth < minActiveWidth ) return

		if ( navWidth > navParentWidth ) {
			// Nav width is too big so we move items to 'more' dropdown.
			while ( navWidth > navParentWidth ) {
				let navLastItem = nav.querySelector( '.autoMore' ).previousElementSibling
				moreContents.prepend( navLastItem )
				navWidth = nav.offsetWidth
				updateClasses( navLastItem )
				if ( navLastItem.classList.contains( inMoreClass ) ) {
					dropdownControl.deregisterHover( navLastItem )
				}
			}

		} else if ( moreContents.children.length > 0 ) {
			// Nav width is smaller than parent and 'more' has children.
			while ( moreContents.children.length > 0 ) {
				let firstChild      = moreContents.firstElementChild
				let firstChildWidth = firstChild.offsetWidth
				let newNavWidth     = navWidth + firstChildWidth + flexGap
				if ( newNavWidth < navParentWidth ) {
					nav.insertBefore( firstChild, more )
					updateClasses( firstChild )
					if ( firstChild.classList.contains( inNavbarClass ) ) {
						dropdownControl.registerHover( firstChild )
					}

					if ( moreContents.children.length === 0 ) break

					firstChild = moreContents.firstElementChild
					firstChildWidth = firstChild.offsetWidth
					navWidth = nav.offsetWidth
					newNavWidth = navWidth + firstChildWidth + flexGap
				} else {
					break
				}
			}
		}

		if ( moreContents.childElementCount > 0 ) {
			more.style.position = 'relative'
			more.style.visibility = 'visible'
		} else {
			more.style.position = 'absolute'
			more.style.visibility = 'hidden'
		}
	}

	/**
	 * Initialise the plugin.
	 */
	const init = () => {
		if ( initialised ) return
		initialised = true

		// Add the 'more' element to all the navs.
		navParents.forEach( ( navParent ) => {
			const moreClone = moreTemplate.content.cloneNode( true )
			const nav       = navParent.querySelector( navSelector )

			nav.appendChild( moreClone )
			const autoMore = nav.querySelector( '.autoMore' )

			// Attach dropdown hover event listeners.
			dropdownControl.registerHover( autoMore )

			// Attach keydown listener to psuedo-button for spacebar/enter key accessibility.
			autoMore.firstElementChild.addEventListener( 'keydown', ( event ) => {
				if ( event.key === ' ' || event.key === 'Enter' || event.key === 'Spacebar' ) {
					event.target.click()
					// Prevent browser scroll on space down (default behaviour in Chrome/Firefox etc).
					event.preventDefault()
				}
			} )
		} )

		// Process the nav items.
		updateAll()
	}

	/**
	 * Throttled window resize trigger.
	 */
	let resizeTimout
	window.onresize = () => {
		clearTimeout( resizeTimout )
		if ( !initialised ) return
		resizeTimout = setTimeout( updateAll, 30 )
	}

	/**
	 * Initialise after page load.
	 */
	let docLoaded = setInterval( () => {
		if ( document.readyState === 'interactive' ) {
			clearInterval( docLoaded )
			init()
		}
	}, 10 )
}

export { menuMore }
