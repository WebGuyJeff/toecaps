/**
 * Toecaps Parallax Module.
 *
 * Handle parallax animation using the GSAP library.
 *
 * @package Toecaps
 * @author Jefferson Real <me@jeffersonreal.uk>
 * @copyright Copyright (c) 2022, Jefferson Real
 */

gsap.registerPlugin( ScrollTrigger )

const parallax = () => {
	const doParallax = () => {
		const paraElems = document.querySelectorAll( '.parallax' );
		[ ...paraElems ].forEach( ( parallax ) => {
			const parallaxInner = parallax.querySelector( '.parallax_inner' )
			const parallaxTrigger = parallax.closest( '.parallax_trigger' )
			const height = parallaxInner.clientHeight

			gsap.to( parallaxInner, {
				y: height / 2,
				z: 0.01,
				ease: 'none',
				scrollTrigger: {
					trigger: parallaxTrigger,
					scrub: true,
					start: 'top top', // top of elem meets top of screen
					end: 'bottom top', // end after scrolling (N)px beyond start.
				},
			} )
		} )
	}

	// Poll for doc ready state
	let docLoaded = setInterval( function () {
		if ( document.readyState === 'complete' ) {
			clearInterval( docLoaded )
			doParallax()
		}
	}, 100 )
}

export { parallax }
