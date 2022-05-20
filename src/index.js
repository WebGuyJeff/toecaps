/**
 * Index file for all js modules.
 * 
 * This file is used to import all Toecaps JS modules and set the theme functionality up. It also
 * provides an entry point for Webpack bundling.
 * 
 * @link https://metabox.io/modernizing-javascript-code-in-wordpress/
 */

import { parallax } from './js/parallax';
import { accordian } from './js/accordian';
import { menuFullscreen } from './js/menu-fullscreen';
import { searchPopup } from './js/search-popup';
import { psuedoButtons } from './js/psuedo-button';
import { dropdownControl } from './js/dropdown';
import { menuMore } from './js/menu-more';

parallax();
accordian.initialise();
menuFullscreen();
searchPopup();
psuedoButtons();
dropdownControl.initialise();
menuMore();