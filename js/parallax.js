/**
 * Toecaps Parallax
 *
 * Handle parallax animation using the GSAP library.
 *
 * @package Toecaps
 * @author Jefferson Real <me@jeffersonreal.uk>
 * @copyright Copyright (c) 2022, Jefferson Real
 */

gsap.registerPlugin(ScrollTrigger);

const parallaxPlugin = (function () {
	gsap.registerPlugin(ScrollTrigger);

	const doParallax = () => {
		const paraElems = document.querySelectorAll('.parallax');
		[...paraElems].forEach((parallax) => {
			const parallaxInner = parallax.querySelector('.parallax_inner');
			const parallaxTrigger = parallax.closest('.parallax_trigger');

			parallaxInner.style.transform = `translateY(0)`;
			const height = parallaxInner.clientHeight;

			gsap.to(parallaxInner, {
				transform: `translateY(${height / 2}px)`, // 25% of parent height;
				ease: 'none',
				scrollTrigger: {
					trigger: parallaxTrigger,
					scrub: true,
					start: 'top top', // top of elem meets top of screen
					end: 'bottom top', // end after scrolling (N)px beyond start.
				},
			});
		});
	};

	// Poll for doc ready state
	let docLoaded = setInterval(function () {
		if (document.readyState === 'complete') {
			clearInterval(docLoaded);
			doParallax();
		}
	}, 100);
})(); //modal plugin end.
