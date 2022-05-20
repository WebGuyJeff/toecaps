/*
 * ATTENTION: An "eval-source-map" devtool has been used.
 * This devtool is neither made for production nor for readable output files.
 * It uses "eval()" calls to create a separate source file with attached SourceMaps in the browser devtools.
 * If you are trying to read the output file, select a different devtool (https://webpack.js.org/configuration/devtool/)
 * or disable the default devtool with "devtool: false".
 * If you are looking for production-ready output files, see mode: "production" (https://webpack.js.org/configuration/mode/).
 */
/******/ (() => { // webpackBootstrap
/******/ 	"use strict";
/******/ 	var __webpack_modules__ = ({

/***/ "./src/js/accordian.js":
/*!*****************************!*\
  !*** ./src/js/accordian.js ***!
  \*****************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

eval("__webpack_require__.r(__webpack_exports__);\n/* harmony export */ __webpack_require__.d(__webpack_exports__, {\n/* harmony export */   \"accordian\": () => (/* binding */ accordian)\n/* harmony export */ });\n/**\n * Toecaps Accordian Module.\n *\n * Toggles the ARIA attributes on accordian toggle buttons.\n *\n * @package Toecaps\n * @author Jefferson Real <me@jeffersonreal.uk>\n * @copyright Copyright (c) 2022, Jefferson Real\n */\n\nconst accordianButtons = [ ...document.querySelectorAll( 'button.accordian_title' ) ];\n\nconst accordian = {\n\n\t/**\n\t * Bind click listeners to accordian buttons.\n\t */\n\tbindEvents: () => accordianButtons.forEach ( element => element.addEventListener(\n\t\t'click',\n\t\tfunction () {\n\t\t\taccordian.toggleAria( this )\n\t\t}\n\t) ),\n\n\t/**\n\t * Toggle ARIA attributes callback.\n\t */\n\ttoggleAria: function( accordian ) {\n\t\taccordian.setAttribute( 'aria-expanded', accordian.getAttribute( 'aria-expanded' ) === 'true' ? 'false' : 'true' );\n\t\taccordian.setAttribute( 'aria-pressed', accordian.getAttribute( 'aria-pressed' ) === 'true' ? 'false' : 'true' );\n\t\t// Toggle the checkbox toggle.\n\t\taccordian.nextElementSibling.click();\n\t},\n\n\t/**\n\t * Initialise on doc ready.\n\t */\n\tinitialise: () => {\n\t\tconst docLoaded = setInterval( function () {\n\t\t\tif ( document.readyState === 'complete' ) {\n\t\t\t\tclearInterval( docLoaded );\n\t\t\t\taccordian.bindEvents();\n\t\t\t}\n\t\t}, 100 );\n\t},\n}\n\n//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJmaWxlIjoiLi9zcmMvanMvYWNjb3JkaWFuLmpzLmpzIiwibWFwcGluZ3MiOiI7Ozs7QUFBQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBIiwic291cmNlcyI6WyJ3ZWJwYWNrOi8vLy4vc3JjL2pzL2FjY29yZGlhbi5qcz9kMzM3Il0sInNvdXJjZXNDb250ZW50IjpbIi8qKlxuICogVG9lY2FwcyBBY2NvcmRpYW4gTW9kdWxlLlxuICpcbiAqIFRvZ2dsZXMgdGhlIEFSSUEgYXR0cmlidXRlcyBvbiBhY2NvcmRpYW4gdG9nZ2xlIGJ1dHRvbnMuXG4gKlxuICogQHBhY2thZ2UgVG9lY2Fwc1xuICogQGF1dGhvciBKZWZmZXJzb24gUmVhbCA8bWVAamVmZmVyc29ucmVhbC51az5cbiAqIEBjb3B5cmlnaHQgQ29weXJpZ2h0IChjKSAyMDIyLCBKZWZmZXJzb24gUmVhbFxuICovXG5cbmNvbnN0IGFjY29yZGlhbkJ1dHRvbnMgPSBbIC4uLmRvY3VtZW50LnF1ZXJ5U2VsZWN0b3JBbGwoICdidXR0b24uYWNjb3JkaWFuX3RpdGxlJyApIF07XG5cbmNvbnN0IGFjY29yZGlhbiA9IHtcblxuXHQvKipcblx0ICogQmluZCBjbGljayBsaXN0ZW5lcnMgdG8gYWNjb3JkaWFuIGJ1dHRvbnMuXG5cdCAqL1xuXHRiaW5kRXZlbnRzOiAoKSA9PiBhY2NvcmRpYW5CdXR0b25zLmZvckVhY2ggKCBlbGVtZW50ID0+IGVsZW1lbnQuYWRkRXZlbnRMaXN0ZW5lcihcblx0XHQnY2xpY2snLFxuXHRcdGZ1bmN0aW9uICgpIHtcblx0XHRcdGFjY29yZGlhbi50b2dnbGVBcmlhKCB0aGlzIClcblx0XHR9XG5cdCkgKSxcblxuXHQvKipcblx0ICogVG9nZ2xlIEFSSUEgYXR0cmlidXRlcyBjYWxsYmFjay5cblx0ICovXG5cdHRvZ2dsZUFyaWE6IGZ1bmN0aW9uKCBhY2NvcmRpYW4gKSB7XG5cdFx0YWNjb3JkaWFuLnNldEF0dHJpYnV0ZSggJ2FyaWEtZXhwYW5kZWQnLCBhY2NvcmRpYW4uZ2V0QXR0cmlidXRlKCAnYXJpYS1leHBhbmRlZCcgKSA9PT0gJ3RydWUnID8gJ2ZhbHNlJyA6ICd0cnVlJyApO1xuXHRcdGFjY29yZGlhbi5zZXRBdHRyaWJ1dGUoICdhcmlhLXByZXNzZWQnLCBhY2NvcmRpYW4uZ2V0QXR0cmlidXRlKCAnYXJpYS1wcmVzc2VkJyApID09PSAndHJ1ZScgPyAnZmFsc2UnIDogJ3RydWUnICk7XG5cdFx0Ly8gVG9nZ2xlIHRoZSBjaGVja2JveCB0b2dnbGUuXG5cdFx0YWNjb3JkaWFuLm5leHRFbGVtZW50U2libGluZy5jbGljaygpO1xuXHR9LFxuXG5cdC8qKlxuXHQgKiBJbml0aWFsaXNlIG9uIGRvYyByZWFkeS5cblx0ICovXG5cdGluaXRpYWxpc2U6ICgpID0+IHtcblx0XHRjb25zdCBkb2NMb2FkZWQgPSBzZXRJbnRlcnZhbCggZnVuY3Rpb24gKCkge1xuXHRcdFx0aWYgKCBkb2N1bWVudC5yZWFkeVN0YXRlID09PSAnY29tcGxldGUnICkge1xuXHRcdFx0XHRjbGVhckludGVydmFsKCBkb2NMb2FkZWQgKTtcblx0XHRcdFx0YWNjb3JkaWFuLmJpbmRFdmVudHMoKTtcblx0XHRcdH1cblx0XHR9LCAxMDAgKTtcblx0fSxcbn1cblxuZXhwb3J0IHsgYWNjb3JkaWFuIH07Il0sIm5hbWVzIjpbXSwic291cmNlUm9vdCI6IiJ9\n//# sourceURL=webpack-internal:///./src/js/accordian.js\n");

/***/ }),

/***/ "./src/js/index.js":
/*!*************************!*\
  !*** ./src/js/index.js ***!
  \*************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

eval("__webpack_require__.r(__webpack_exports__);\n/* harmony import */ var _parallax_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./parallax.js */ \"./src/js/parallax.js\");\n/* harmony import */ var _accordian_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./accordian.js */ \"./src/js/accordian.js\");\n/**\n * Index file for all js modules.\n * \n * \n * @link https://metabox.io/modernizing-javascript-code-in-wordpress/\n */\n\n\n\n(0,_parallax_js__WEBPACK_IMPORTED_MODULE_0__.parallax)();\n_accordian_js__WEBPACK_IMPORTED_MODULE_1__.accordian.initialise();//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJmaWxlIjoiLi9zcmMvanMvaW5kZXguanMuanMiLCJtYXBwaW5ncyI6Ijs7O0FBQUE7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQSIsInNvdXJjZXMiOlsid2VicGFjazovLy8uL3NyYy9qcy9pbmRleC5qcz83YmE1Il0sInNvdXJjZXNDb250ZW50IjpbIi8qKlxuICogSW5kZXggZmlsZSBmb3IgYWxsIGpzIG1vZHVsZXMuXG4gKiBcbiAqIFxuICogQGxpbmsgaHR0cHM6Ly9tZXRhYm94LmlvL21vZGVybml6aW5nLWphdmFzY3JpcHQtY29kZS1pbi13b3JkcHJlc3MvXG4gKi9cblxuaW1wb3J0IHsgcGFyYWxsYXggfSBmcm9tICcuL3BhcmFsbGF4LmpzJztcbmltcG9ydCB7IGFjY29yZGlhbiB9IGZyb20gJy4vYWNjb3JkaWFuLmpzJztcbnBhcmFsbGF4KCk7XG5hY2NvcmRpYW4uaW5pdGlhbGlzZSgpOyJdLCJuYW1lcyI6W10sInNvdXJjZVJvb3QiOiIifQ==\n//# sourceURL=webpack-internal:///./src/js/index.js\n");

/***/ }),

/***/ "./src/js/parallax.js":
/*!****************************!*\
  !*** ./src/js/parallax.js ***!
  \****************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

eval("__webpack_require__.r(__webpack_exports__);\n/* harmony export */ __webpack_require__.d(__webpack_exports__, {\n/* harmony export */   \"parallax\": () => (/* binding */ parallax)\n/* harmony export */ });\n/**\n * Toecaps Parallax Module.\n *\n * Handle parallax animation using the GSAP library.\n *\n * @package Toecaps\n * @author Jefferson Real <me@jeffersonreal.uk>\n * @copyright Copyright (c) 2022, Jefferson Real\n */\n\nconst parallax = () => {\n\tgsap.registerPlugin( ScrollTrigger );\n\n\tconst doParallax = () => {\n\t\tconst paraElems = document.querySelectorAll( '.parallax' );\n\t\t[...paraElems].forEach((parallax) => {\n\t\t\tconst parallaxInner   = parallax.querySelector( '.parallax_inner' );\n\t\t\tconst parallaxTrigger = parallax.closest( '.parallax_trigger' );\n\t\t\tconst height          = parallaxInner.clientHeight;\n\n\t\t\tgsap.to( parallaxInner, {\n\t\t\t\ty: height / 2,\n\t\t\t\tz:0.01,\n\t\t\t\tease: 'none',\n\t\t\t\tscrollTrigger: {\n\t\t\t\t\ttrigger: parallaxTrigger,\n\t\t\t\t\tscrub: true,\n\t\t\t\t\tstart: 'top top', // top of elem meets top of screen\n\t\t\t\t\tend: 'bottom top', // end after scrolling (N)px beyond start.\n\t\t\t\t},\n\t\t\t});\n\t\t});\n\t};\n\n\t// Poll for doc ready state\n\tlet docLoaded = setInterval( function () {\n\t\tif ( document.readyState === 'complete' ) {\n\t\t\tclearInterval( docLoaded );\n\t\t\tdoParallax();\n\t\t}\n\t}, 100 );\n};\n\n\n//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJmaWxlIjoiLi9zcmMvanMvcGFyYWxsYXguanMuanMiLCJtYXBwaW5ncyI6Ijs7OztBQUFBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0EiLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8vLi9zcmMvanMvcGFyYWxsYXguanM/M2U4NyJdLCJzb3VyY2VzQ29udGVudCI6WyIvKipcbiAqIFRvZWNhcHMgUGFyYWxsYXggTW9kdWxlLlxuICpcbiAqIEhhbmRsZSBwYXJhbGxheCBhbmltYXRpb24gdXNpbmcgdGhlIEdTQVAgbGlicmFyeS5cbiAqXG4gKiBAcGFja2FnZSBUb2VjYXBzXG4gKiBAYXV0aG9yIEplZmZlcnNvbiBSZWFsIDxtZUBqZWZmZXJzb25yZWFsLnVrPlxuICogQGNvcHlyaWdodCBDb3B5cmlnaHQgKGMpIDIwMjIsIEplZmZlcnNvbiBSZWFsXG4gKi9cblxuY29uc3QgcGFyYWxsYXggPSAoKSA9PiB7XG5cdGdzYXAucmVnaXN0ZXJQbHVnaW4oIFNjcm9sbFRyaWdnZXIgKTtcblxuXHRjb25zdCBkb1BhcmFsbGF4ID0gKCkgPT4ge1xuXHRcdGNvbnN0IHBhcmFFbGVtcyA9IGRvY3VtZW50LnF1ZXJ5U2VsZWN0b3JBbGwoICcucGFyYWxsYXgnICk7XG5cdFx0Wy4uLnBhcmFFbGVtc10uZm9yRWFjaCgocGFyYWxsYXgpID0+IHtcblx0XHRcdGNvbnN0IHBhcmFsbGF4SW5uZXIgICA9IHBhcmFsbGF4LnF1ZXJ5U2VsZWN0b3IoICcucGFyYWxsYXhfaW5uZXInICk7XG5cdFx0XHRjb25zdCBwYXJhbGxheFRyaWdnZXIgPSBwYXJhbGxheC5jbG9zZXN0KCAnLnBhcmFsbGF4X3RyaWdnZXInICk7XG5cdFx0XHRjb25zdCBoZWlnaHQgICAgICAgICAgPSBwYXJhbGxheElubmVyLmNsaWVudEhlaWdodDtcblxuXHRcdFx0Z3NhcC50byggcGFyYWxsYXhJbm5lciwge1xuXHRcdFx0XHR5OiBoZWlnaHQgLyAyLFxuXHRcdFx0XHR6OjAuMDEsXG5cdFx0XHRcdGVhc2U6ICdub25lJyxcblx0XHRcdFx0c2Nyb2xsVHJpZ2dlcjoge1xuXHRcdFx0XHRcdHRyaWdnZXI6IHBhcmFsbGF4VHJpZ2dlcixcblx0XHRcdFx0XHRzY3J1YjogdHJ1ZSxcblx0XHRcdFx0XHRzdGFydDogJ3RvcCB0b3AnLCAvLyB0b3Agb2YgZWxlbSBtZWV0cyB0b3Agb2Ygc2NyZWVuXG5cdFx0XHRcdFx0ZW5kOiAnYm90dG9tIHRvcCcsIC8vIGVuZCBhZnRlciBzY3JvbGxpbmcgKE4pcHggYmV5b25kIHN0YXJ0LlxuXHRcdFx0XHR9LFxuXHRcdFx0fSk7XG5cdFx0fSk7XG5cdH07XG5cblx0Ly8gUG9sbCBmb3IgZG9jIHJlYWR5IHN0YXRlXG5cdGxldCBkb2NMb2FkZWQgPSBzZXRJbnRlcnZhbCggZnVuY3Rpb24gKCkge1xuXHRcdGlmICggZG9jdW1lbnQucmVhZHlTdGF0ZSA9PT0gJ2NvbXBsZXRlJyApIHtcblx0XHRcdGNsZWFySW50ZXJ2YWwoIGRvY0xvYWRlZCApO1xuXHRcdFx0ZG9QYXJhbGxheCgpO1xuXHRcdH1cblx0fSwgMTAwICk7XG59O1xuXG5leHBvcnQgeyBwYXJhbGxheCB9O1xuIl0sIm5hbWVzIjpbXSwic291cmNlUm9vdCI6IiJ9\n//# sourceURL=webpack-internal:///./src/js/parallax.js\n");

/***/ })

/******/ 	});
/************************************************************************/
/******/ 	// The module cache
/******/ 	var __webpack_module_cache__ = {};
/******/ 	
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/ 		// Check if module is in cache
/******/ 		var cachedModule = __webpack_module_cache__[moduleId];
/******/ 		if (cachedModule !== undefined) {
/******/ 			return cachedModule.exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = __webpack_module_cache__[moduleId] = {
/******/ 			// no module.id needed
/******/ 			// no module.loaded needed
/******/ 			exports: {}
/******/ 		};
/******/ 	
/******/ 		// Execute the module function
/******/ 		__webpack_modules__[moduleId](module, module.exports, __webpack_require__);
/******/ 	
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/ 	
/************************************************************************/
/******/ 	/* webpack/runtime/define property getters */
/******/ 	(() => {
/******/ 		// define getter functions for harmony exports
/******/ 		__webpack_require__.d = (exports, definition) => {
/******/ 			for(var key in definition) {
/******/ 				if(__webpack_require__.o(definition, key) && !__webpack_require__.o(exports, key)) {
/******/ 					Object.defineProperty(exports, key, { enumerable: true, get: definition[key] });
/******/ 				}
/******/ 			}
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/hasOwnProperty shorthand */
/******/ 	(() => {
/******/ 		__webpack_require__.o = (obj, prop) => (Object.prototype.hasOwnProperty.call(obj, prop))
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/make namespace object */
/******/ 	(() => {
/******/ 		// define __esModule on exports
/******/ 		__webpack_require__.r = (exports) => {
/******/ 			if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 				Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 			}
/******/ 			Object.defineProperty(exports, '__esModule', { value: true });
/******/ 		};
/******/ 	})();
/******/ 	
/************************************************************************/
/******/ 	
/******/ 	// startup
/******/ 	// Load entry module and return exports
/******/ 	// This entry module can't be inlined because the eval-source-map devtool is used.
/******/ 	var __webpack_exports__ = __webpack_require__("./src/js/index.js");
/******/ 	
/******/ })()
;