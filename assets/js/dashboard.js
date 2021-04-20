/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "/";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 0);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./assets/src/sass/styles.scss":
/*!*************************************!*\
  !*** ./assets/src/sass/styles.scss ***!
  \*************************************/
/*! no static exports found */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),

/***/ "./inc/Admin/react/sass/dashboard.scss":
/*!*********************************************!*\
  !*** ./inc/Admin/react/sass/dashboard.scss ***!
  \*********************************************/
/*! no static exports found */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),

/***/ "./inc/Admin/react/src/components/Navbar.js":
/*!**************************************************!*\
  !*** ./inc/Admin/react/src/components/Navbar.js ***!
  \**************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
var Navbar = function Navbar() {
  return /*#__PURE__*/React.createElement("div", {
    className: "gridly-navbar"
  }, /*#__PURE__*/React.createElement("ul", null, /*#__PURE__*/React.createElement("li", null, /*#__PURE__*/React.createElement("a", {
    href: "#"
  }, "General")), /*#__PURE__*/React.createElement("li", null, /*#__PURE__*/React.createElement("a", {
    href: "#"
  }, "Advanced")), /*#__PURE__*/React.createElement("li", null, /*#__PURE__*/React.createElement("a", {
    href: "#"
  }, "More"))));
};

/* harmony default export */ __webpack_exports__["default"] = (Navbar);

/***/ }),

/***/ "./inc/Admin/react/src/dashboard.js":
/*!******************************************!*\
  !*** ./inc/Admin/react/src/dashboard.js ***!
  \******************************************/
/*! no exports provided */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _views_Dashboard_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./views/Dashboard.js */ "./inc/Admin/react/src/views/Dashboard.js");
var render = wp.element.render;

render( /*#__PURE__*/React.createElement(_views_Dashboard_js__WEBPACK_IMPORTED_MODULE_0__["default"], null), document.getElementById('gridly-dashboard'));

/***/ }),

/***/ "./inc/Admin/react/src/views/Dashboard.js":
/*!************************************************!*\
  !*** ./inc/Admin/react/src/views/Dashboard.js ***!
  \************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _Layout__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./Layout */ "./inc/Admin/react/src/views/Layout.js");
function _slicedToArray(arr, i) { return _arrayWithHoles(arr) || _iterableToArrayLimit(arr, i) || _unsupportedIterableToArray(arr, i) || _nonIterableRest(); }

function _nonIterableRest() { throw new TypeError("Invalid attempt to destructure non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); }

function _unsupportedIterableToArray(o, minLen) { if (!o) return; if (typeof o === "string") return _arrayLikeToArray(o, minLen); var n = Object.prototype.toString.call(o).slice(8, -1); if (n === "Object" && o.constructor) n = o.constructor.name; if (n === "Map" || n === "Set") return Array.from(o); if (n === "Arguments" || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)) return _arrayLikeToArray(o, minLen); }

function _arrayLikeToArray(arr, len) { if (len == null || len > arr.length) len = arr.length; for (var i = 0, arr2 = new Array(len); i < len; i++) { arr2[i] = arr[i]; } return arr2; }

function _iterableToArrayLimit(arr, i) { if (typeof Symbol === "undefined" || !(Symbol.iterator in Object(arr))) return; var _arr = []; var _n = true; var _d = false; var _e = undefined; try { for (var _i = arr[Symbol.iterator](), _s; !(_n = (_s = _i.next()).done); _n = true) { _arr.push(_s.value); if (i && _arr.length === i) break; } } catch (err) { _d = true; _e = err; } finally { try { if (!_n && _i["return"] != null) _i["return"](); } finally { if (_d) throw _e; } } return _arr; }

function _arrayWithHoles(arr) { if (Array.isArray(arr)) return arr; }

var __ = wp.i18n.__;
var useState = wp.element.useState;
var _wp$components = wp.components,
    TextControl = _wp$components.TextControl,
    ToggleControl = _wp$components.ToggleControl,
    ExternalLink = _wp$components.ExternalLink,
    Button = _wp$components.Button;


var Dashboard = function Dashboard() {
  var _useState = useState(''),
      _useState2 = _slicedToArray(_useState, 2),
      tmdbApi = _useState2[0],
      setTmdbApi = _useState2[1];

  var _useState3 = useState(''),
      _useState4 = _slicedToArray(_useState3, 2),
      amazonApi = _useState4[0],
      setAmazonApi = _useState4[1];

  var _useState5 = useState(true),
      _useState6 = _slicedToArray(_useState5, 2),
      enableTmdb = _useState6[0],
      setEnableTmdb = _useState6[1];

  var _useState7 = useState(true),
      _useState8 = _slicedToArray(_useState7, 2),
      enableAmazon = _useState8[0],
      setEnableAmazon = _useState8[1];

  var handleSubmit = function handleSubmit(e) {
    e.preventDefault();
    var data = new FormData();
    data.append('action', 'submit_form_data');
    data.append('security', eap.nonce);
    data.append('tmdbApi', tmdbApi);
    data.append('amazonApi', amazonApi);
    var request = new XMLHttpRequest();
    request.open('POST', eap.ajax_url);
    request.send(data);
  };

  return /*#__PURE__*/React.createElement(_Layout__WEBPACK_IMPORTED_MODULE_0__["default"], null, /*#__PURE__*/React.createElement("section", {
    className: "gridly-general-container"
  }, /*#__PURE__*/React.createElement("h1", {
    className: "gridly-title"
  }, __('Dashboard Component', 'gridly')), /*#__PURE__*/React.createElement("div", {
    className: "gridly-block-container"
  }, /*#__PURE__*/React.createElement("div", {
    className: "gridly-single-item"
  }, "TBD"))));
};

/* harmony default export */ __webpack_exports__["default"] = (Dashboard);

/***/ }),

/***/ "./inc/Admin/react/src/views/Layout.js":
/*!*********************************************!*\
  !*** ./inc/Admin/react/src/views/Layout.js ***!
  \*********************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _components_Navbar__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../components/Navbar */ "./inc/Admin/react/src/components/Navbar.js");
var Fragment = wp.element.Fragment;


var Layout = function Layout(_ref) {
  var children = _ref.children;
  return /*#__PURE__*/React.createElement(Fragment, null, /*#__PURE__*/React.createElement(_components_Navbar__WEBPACK_IMPORTED_MODULE_0__["default"], null), children);
};

/* harmony default export */ __webpack_exports__["default"] = (Layout);

/***/ }),

/***/ 0:
/*!********************************************************************************************************************!*\
  !*** multi ./inc/Admin/react/src/dashboard.js ./assets/src/sass/styles.scss ./inc/Admin/react/sass/dashboard.scss ***!
  \********************************************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(/*! /Volumes/Web/Projects/Local Sites/elementor/app/public/wp-content/plugins/gridly/inc/Admin/react/src/dashboard.js */"./inc/Admin/react/src/dashboard.js");
__webpack_require__(/*! /Volumes/Web/Projects/Local Sites/elementor/app/public/wp-content/plugins/gridly/assets/src/sass/styles.scss */"./assets/src/sass/styles.scss");
module.exports = __webpack_require__(/*! /Volumes/Web/Projects/Local Sites/elementor/app/public/wp-content/plugins/gridly/inc/Admin/react/sass/dashboard.scss */"./inc/Admin/react/sass/dashboard.scss");


/***/ })

/******/ });