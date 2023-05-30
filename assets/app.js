/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import './styles/app.scss';

// start the Stimulus application
import './bootstrap';

//Import of Tailwind elements
import 'tw-elements';

// JS import
import "./javascripts/toggleFilters";
import "./javascripts/ajaxRequest";
import "./javascripts/datePickerCalculPrice";
import "./javascripts/dynamicStyleFilterSelection";
import "./javascripts/toggleSearchBar";
import './javascripts/toggleBurgerMenu';
import './javascripts/toggleAvatarUpdate';
import './javascripts/toggleEditDescriptionProfile';
import './javascripts/toggleBtnSearchContainer';