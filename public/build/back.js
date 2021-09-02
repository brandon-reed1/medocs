(self["webpackChunk"] = self["webpackChunk"] || []).push([["back"],{

/***/ "./assets/controllers sync recursive ./node_modules/@symfony/stimulus-bridge/lazy-controller-loader.js! \\.(j|t)sx?$":
/*!*****************************************************************************************************************!*\
  !*** ./assets/controllers/ sync ./node_modules/@symfony/stimulus-bridge/lazy-controller-loader.js! \.(j|t)sx?$ ***!
  \*****************************************************************************************************************/
/***/ ((module, __unused_webpack_exports, __webpack_require__) => {

var map = {
	"./hello_controller.js": "./node_modules/@symfony/stimulus-bridge/lazy-controller-loader.js!./assets/controllers/hello_controller.js"
};


function webpackContext(req) {
	var id = webpackContextResolve(req);
	return __webpack_require__(id);
}
function webpackContextResolve(req) {
	if(!__webpack_require__.o(map, req)) {
		var e = new Error("Cannot find module '" + req + "'");
		e.code = 'MODULE_NOT_FOUND';
		throw e;
	}
	return map[req];
}
webpackContext.keys = function webpackContextKeys() {
	return Object.keys(map);
};
webpackContext.resolve = webpackContextResolve;
module.exports = webpackContext;
webpackContext.id = "./assets/controllers sync recursive ./node_modules/@symfony/stimulus-bridge/lazy-controller-loader.js! \\.(j|t)sx?$";

/***/ }),

/***/ "./node_modules/@symfony/stimulus-bridge/dist/webpack/loader.js!./assets/controllers.json":
/*!************************************************************************************************!*\
  !*** ./node_modules/@symfony/stimulus-bridge/dist/webpack/loader.js!./assets/controllers.json ***!
  \************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = ({
});

/***/ }),

/***/ "./node_modules/@symfony/stimulus-bridge/lazy-controller-loader.js!./assets/controllers/hello_controller.js":
/*!******************************************************************************************************************!*\
  !*** ./node_modules/@symfony/stimulus-bridge/lazy-controller-loader.js!./assets/controllers/hello_controller.js ***!
  \******************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (/* binding */ _default)
/* harmony export */ });
/* harmony import */ var core_js_modules_es_object_set_prototype_of_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! core-js/modules/es.object.set-prototype-of.js */ "./node_modules/core-js/modules/es.object.set-prototype-of.js");
/* harmony import */ var core_js_modules_es_object_set_prototype_of_js__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_object_set_prototype_of_js__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var core_js_modules_es_object_get_prototype_of_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! core-js/modules/es.object.get-prototype-of.js */ "./node_modules/core-js/modules/es.object.get-prototype-of.js");
/* harmony import */ var core_js_modules_es_object_get_prototype_of_js__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_object_get_prototype_of_js__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var core_js_modules_es_reflect_construct_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! core-js/modules/es.reflect.construct.js */ "./node_modules/core-js/modules/es.reflect.construct.js");
/* harmony import */ var core_js_modules_es_reflect_construct_js__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_reflect_construct_js__WEBPACK_IMPORTED_MODULE_2__);
/* harmony import */ var core_js_modules_es_object_create_js__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! core-js/modules/es.object.create.js */ "./node_modules/core-js/modules/es.object.create.js");
/* harmony import */ var core_js_modules_es_object_create_js__WEBPACK_IMPORTED_MODULE_3___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_object_create_js__WEBPACK_IMPORTED_MODULE_3__);
/* harmony import */ var core_js_modules_es_object_define_property_js__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! core-js/modules/es.object.define-property.js */ "./node_modules/core-js/modules/es.object.define-property.js");
/* harmony import */ var core_js_modules_es_object_define_property_js__WEBPACK_IMPORTED_MODULE_4___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_object_define_property_js__WEBPACK_IMPORTED_MODULE_4__);
/* harmony import */ var core_js_modules_es_symbol_js__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! core-js/modules/es.symbol.js */ "./node_modules/core-js/modules/es.symbol.js");
/* harmony import */ var core_js_modules_es_symbol_js__WEBPACK_IMPORTED_MODULE_5___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_symbol_js__WEBPACK_IMPORTED_MODULE_5__);
/* harmony import */ var core_js_modules_es_symbol_description_js__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(/*! core-js/modules/es.symbol.description.js */ "./node_modules/core-js/modules/es.symbol.description.js");
/* harmony import */ var core_js_modules_es_symbol_description_js__WEBPACK_IMPORTED_MODULE_6___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_symbol_description_js__WEBPACK_IMPORTED_MODULE_6__);
/* harmony import */ var core_js_modules_es_object_to_string_js__WEBPACK_IMPORTED_MODULE_7__ = __webpack_require__(/*! core-js/modules/es.object.to-string.js */ "./node_modules/core-js/modules/es.object.to-string.js");
/* harmony import */ var core_js_modules_es_object_to_string_js__WEBPACK_IMPORTED_MODULE_7___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_object_to_string_js__WEBPACK_IMPORTED_MODULE_7__);
/* harmony import */ var core_js_modules_es_symbol_iterator_js__WEBPACK_IMPORTED_MODULE_8__ = __webpack_require__(/*! core-js/modules/es.symbol.iterator.js */ "./node_modules/core-js/modules/es.symbol.iterator.js");
/* harmony import */ var core_js_modules_es_symbol_iterator_js__WEBPACK_IMPORTED_MODULE_8___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_symbol_iterator_js__WEBPACK_IMPORTED_MODULE_8__);
/* harmony import */ var core_js_modules_es_array_iterator_js__WEBPACK_IMPORTED_MODULE_9__ = __webpack_require__(/*! core-js/modules/es.array.iterator.js */ "./node_modules/core-js/modules/es.array.iterator.js");
/* harmony import */ var core_js_modules_es_array_iterator_js__WEBPACK_IMPORTED_MODULE_9___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_array_iterator_js__WEBPACK_IMPORTED_MODULE_9__);
/* harmony import */ var core_js_modules_es_string_iterator_js__WEBPACK_IMPORTED_MODULE_10__ = __webpack_require__(/*! core-js/modules/es.string.iterator.js */ "./node_modules/core-js/modules/es.string.iterator.js");
/* harmony import */ var core_js_modules_es_string_iterator_js__WEBPACK_IMPORTED_MODULE_10___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_string_iterator_js__WEBPACK_IMPORTED_MODULE_10__);
/* harmony import */ var core_js_modules_web_dom_collections_iterator_js__WEBPACK_IMPORTED_MODULE_11__ = __webpack_require__(/*! core-js/modules/web.dom-collections.iterator.js */ "./node_modules/core-js/modules/web.dom-collections.iterator.js");
/* harmony import */ var core_js_modules_web_dom_collections_iterator_js__WEBPACK_IMPORTED_MODULE_11___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_web_dom_collections_iterator_js__WEBPACK_IMPORTED_MODULE_11__);
/* harmony import */ var stimulus__WEBPACK_IMPORTED_MODULE_12__ = __webpack_require__(/*! stimulus */ "./node_modules/stimulus/index.js");
function _typeof(obj) { "@babel/helpers - typeof"; if (typeof Symbol === "function" && typeof Symbol.iterator === "symbol") { _typeof = function _typeof(obj) { return typeof obj; }; } else { _typeof = function _typeof(obj) { return obj && typeof Symbol === "function" && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : typeof obj; }; } return _typeof(obj); }














function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } }

function _createClass(Constructor, protoProps, staticProps) { if (protoProps) _defineProperties(Constructor.prototype, protoProps); if (staticProps) _defineProperties(Constructor, staticProps); return Constructor; }

function _inherits(subClass, superClass) { if (typeof superClass !== "function" && superClass !== null) { throw new TypeError("Super expression must either be null or a function"); } subClass.prototype = Object.create(superClass && superClass.prototype, { constructor: { value: subClass, writable: true, configurable: true } }); if (superClass) _setPrototypeOf(subClass, superClass); }

function _setPrototypeOf(o, p) { _setPrototypeOf = Object.setPrototypeOf || function _setPrototypeOf(o, p) { o.__proto__ = p; return o; }; return _setPrototypeOf(o, p); }

function _createSuper(Derived) { var hasNativeReflectConstruct = _isNativeReflectConstruct(); return function _createSuperInternal() { var Super = _getPrototypeOf(Derived), result; if (hasNativeReflectConstruct) { var NewTarget = _getPrototypeOf(this).constructor; result = Reflect.construct(Super, arguments, NewTarget); } else { result = Super.apply(this, arguments); } return _possibleConstructorReturn(this, result); }; }

function _possibleConstructorReturn(self, call) { if (call && (_typeof(call) === "object" || typeof call === "function")) { return call; } return _assertThisInitialized(self); }

function _assertThisInitialized(self) { if (self === void 0) { throw new ReferenceError("this hasn't been initialised - super() hasn't been called"); } return self; }

function _isNativeReflectConstruct() { if (typeof Reflect === "undefined" || !Reflect.construct) return false; if (Reflect.construct.sham) return false; if (typeof Proxy === "function") return true; try { Boolean.prototype.valueOf.call(Reflect.construct(Boolean, [], function () {})); return true; } catch (e) { return false; } }

function _getPrototypeOf(o) { _getPrototypeOf = Object.setPrototypeOf ? Object.getPrototypeOf : function _getPrototypeOf(o) { return o.__proto__ || Object.getPrototypeOf(o); }; return _getPrototypeOf(o); }


/*
 * This is an example Stimulus controller!
 *
 * Any element with a data-controller="hello" attribute will cause
 * this controller to be executed. The name "hello" comes from the filename:
 * hello_controller.js -> "hello"
 *
 * Delete this file or adapt it for your use!
 */

var _default = /*#__PURE__*/function (_Controller) {
  _inherits(_default, _Controller);

  var _super = _createSuper(_default);

  function _default() {
    _classCallCheck(this, _default);

    return _super.apply(this, arguments);
  }

  _createClass(_default, [{
    key: "connect",
    value: function connect() {
      this.element.textContent = 'Hello Stimulus! Edit me in assets/controllers/hello_controller.js';
    }
  }]);

  return _default;
}(stimulus__WEBPACK_IMPORTED_MODULE_12__.Controller);



/***/ }),

/***/ "./assets/back.js":
/*!************************!*\
  !*** ./assets/back.js ***!
  \************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _styles_back_scss__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./styles/back.scss */ "./assets/styles/back.scss");
/* harmony import */ var _bootstrap__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./bootstrap */ "./assets/bootstrap.js");
/* harmony import */ var faker__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! faker */ "./node_modules/faker/index.js");
/* harmony import */ var faker__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(faker__WEBPACK_IMPORTED_MODULE_2__);
/* harmony import */ var _js_qr_code__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ./js/qr-code */ "./assets/js/qr-code.js");
/* harmony import */ var _js_qr_code__WEBPACK_IMPORTED_MODULE_3___default = /*#__PURE__*/__webpack_require__.n(_js_qr_code__WEBPACK_IMPORTED_MODULE_3__);
/* harmony import */ var _js_faker__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ./js/faker */ "./assets/js/faker.js");
/* harmony import */ var _js_main__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! ./js/main */ "./assets/js/main.js");
/* harmony import */ var _js_main__WEBPACK_IMPORTED_MODULE_5___default = /*#__PURE__*/__webpack_require__.n(_js_main__WEBPACK_IMPORTED_MODULE_5__);
/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */
// any CSS you import will output into a single css file (app.css in this case)
 // start the Stimulus application







/***/ }),

/***/ "./assets/bootstrap.js":
/*!*****************************!*\
  !*** ./assets/bootstrap.js ***!
  \*****************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "app": () => (/* binding */ app)
/* harmony export */ });
/* harmony import */ var _symfony_stimulus_bridge__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @symfony/stimulus-bridge */ "./node_modules/@symfony/stimulus-bridge/dist/index.js");
 // Registers Stimulus controllers from controllers.json and in the controllers/ directory

var app = (0,_symfony_stimulus_bridge__WEBPACK_IMPORTED_MODULE_0__.startStimulusApp)(__webpack_require__("./assets/controllers sync recursive ./node_modules/@symfony/stimulus-bridge/lazy-controller-loader.js! \\.(j|t)sx?$")); // register any custom, 3rd party controllers here
// app.register('some_controller_name', SomeImportedController);

/***/ }),

/***/ "./assets/js/faker.js":
/*!****************************!*\
  !*** ./assets/js/faker.js ***!
  \****************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var faker__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! faker */ "./node_modules/faker/index.js");
/* harmony import */ var faker__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(faker__WEBPACK_IMPORTED_MODULE_0__);

/***************/

/* fakers      */

/***************/

(faker__WEBPACK_IMPORTED_MODULE_0___default().locale) = 'fr';
var btn = document.getElementById('faker_button');
var input_field = document.getElementById('url_url');
btn.addEventListener('click', function (e) {
  e.preventDefault();
  input_field.value = faker__WEBPACK_IMPORTED_MODULE_0___default().internet.userName();
});

/***/ }),

/***/ "./assets/js/main.js":
/*!***************************!*\
  !*** ./assets/js/main.js ***!
  \***************************/
/***/ ((__unused_webpack_module, __unused_webpack_exports, __webpack_require__) => {

__webpack_require__(/*! core-js/modules/es.array.slice.js */ "./node_modules/core-js/modules/es.array.slice.js");

__webpack_require__(/*! core-js/modules/es.object.to-string.js */ "./node_modules/core-js/modules/es.object.to-string.js");

__webpack_require__(/*! core-js/modules/es.function.name.js */ "./node_modules/core-js/modules/es.function.name.js");

__webpack_require__(/*! core-js/modules/es.array.from.js */ "./node_modules/core-js/modules/es.array.from.js");

__webpack_require__(/*! core-js/modules/es.string.iterator.js */ "./node_modules/core-js/modules/es.string.iterator.js");

__webpack_require__(/*! core-js/modules/es.symbol.js */ "./node_modules/core-js/modules/es.symbol.js");

__webpack_require__(/*! core-js/modules/es.symbol.description.js */ "./node_modules/core-js/modules/es.symbol.description.js");

__webpack_require__(/*! core-js/modules/es.symbol.iterator.js */ "./node_modules/core-js/modules/es.symbol.iterator.js");

__webpack_require__(/*! core-js/modules/es.array.iterator.js */ "./node_modules/core-js/modules/es.array.iterator.js");

__webpack_require__(/*! core-js/modules/web.dom-collections.iterator.js */ "./node_modules/core-js/modules/web.dom-collections.iterator.js");

__webpack_require__(/*! core-js/modules/es.array.is-array.js */ "./node_modules/core-js/modules/es.array.is-array.js");

function _createForOfIteratorHelper(o, allowArrayLike) { var it = typeof Symbol !== "undefined" && o[Symbol.iterator] || o["@@iterator"]; if (!it) { if (Array.isArray(o) || (it = _unsupportedIterableToArray(o)) || allowArrayLike && o && typeof o.length === "number") { if (it) o = it; var i = 0; var F = function F() {}; return { s: F, n: function n() { if (i >= o.length) return { done: true }; return { done: false, value: o[i++] }; }, e: function e(_e) { throw _e; }, f: F }; } throw new TypeError("Invalid attempt to iterate non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); } var normalCompletion = true, didErr = false, err; return { s: function s() { it = it.call(o); }, n: function n() { var step = it.next(); normalCompletion = step.done; return step; }, e: function e(_e2) { didErr = true; err = _e2; }, f: function f() { try { if (!normalCompletion && it["return"] != null) it["return"](); } finally { if (didErr) throw err; } } }; }

function _unsupportedIterableToArray(o, minLen) { if (!o) return; if (typeof o === "string") return _arrayLikeToArray(o, minLen); var n = Object.prototype.toString.call(o).slice(8, -1); if (n === "Object" && o.constructor) n = o.constructor.name; if (n === "Map" || n === "Set") return Array.from(o); if (n === "Arguments" || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)) return _arrayLikeToArray(o, minLen); }

function _arrayLikeToArray(arr, len) { if (len == null || len > arr.length) len = arr.length; for (var i = 0, arr2 = new Array(len); i < len; i++) { arr2[i] = arr[i]; } return arr2; }

/* ************************* */

/* ***** LATERAL MENU ****** */

/****************************/
var menus = document.querySelectorAll("#menu, #sidebar-menu");
var sidebar = document.getElementById("sidebar");
var contentLogo = document.getElementById('content-logo');

var _iterator = _createForOfIteratorHelper(menus),
    _step;

try {
  for (_iterator.s(); !(_step = _iterator.n()).done;) {
    var menu = _step.value;
    menu.addEventListener('click', function () {
      if (sidebar.classList.contains('show')) {
        sidebar.classList.remove('show');

        if (contentLogo.classList.contains('hide')) {
          contentLogo.classList.remove('hide');
        }
      } else {
        sidebar.classList.add('show');

        if (!contentLogo.classList.contains('hide')) {
          contentLogo.classList.add('hide');
        }
      }
    });
  }
} catch (err) {
  _iterator.e(err);
} finally {
  _iterator.f();
}

/***/ }),

/***/ "./assets/js/qr-code.js":
/*!******************************!*\
  !*** ./assets/js/qr-code.js ***!
  \******************************/
/***/ (() => {

var show_btn = document.getElementById('qr-cta-show');
var hide_btn = document.getElementById('qr-cta-hide');
var qr_container = document.getElementById('qr-cta');

if (show_btn !== undefined) {
  show_btn.addEventListener('click', function (e) {
    qr_container.classList.add('show');
    show_btn.classList.add('hide');
    hide_btn.classList.toggle('hide');
  });
}

if (hide_btn !== undefined) {
  hide_btn.addEventListener('click', function (e) {
    qr_container.classList.toggle('show');
    show_btn.classList.toggle('hide');
    hide_btn.classList.toggle('hide');
  });
}

/***/ }),

/***/ "./assets/styles/back.scss":
/*!*********************************!*\
  !*** ./assets/styles/back.scss ***!
  \*********************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ })

},
/******/ __webpack_require__ => { // webpackRuntimeModules
/******/ "use strict";
/******/ 
/******/ var __webpack_exec__ = (moduleId) => (__webpack_require__(__webpack_require__.s = moduleId))
/******/ __webpack_require__.O(0, ["vendors-node_modules_symfony_stimulus-bridge_dist_index_js-node_modules_core-js_modules_es_ob-7db861","vendors-node_modules_core-js_modules_es_array_from_js-node_modules_core-js_modules_es_array_i-86f3a4"], () => (__webpack_exec__("./assets/back.js")));
/******/ var __webpack_exports__ = __webpack_require__.O();
/******/ }
]);
//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8vfC9cXC4oanx0KXN4Iiwid2VicGFjazovLy8uL2Fzc2V0cy9jb250cm9sbGVycy5qc29uIiwid2VicGFjazovLy8uL2Fzc2V0cy9jb250cm9sbGVycy9oZWxsb19jb250cm9sbGVyLmpzIiwid2VicGFjazovLy8uL2Fzc2V0cy9iYWNrLmpzIiwid2VicGFjazovLy8uL2Fzc2V0cy9ib290c3RyYXAuanMiLCJ3ZWJwYWNrOi8vLy4vYXNzZXRzL2pzL2Zha2VyLmpzIiwid2VicGFjazovLy8uL2Fzc2V0cy9qcy9tYWluLmpzIiwid2VicGFjazovLy8uL2Fzc2V0cy9qcy9xci1jb2RlLmpzIiwid2VicGFjazovLy8uL2Fzc2V0cy9zdHlsZXMvYmFjay5zY3NzIl0sIm5hbWVzIjpbImVsZW1lbnQiLCJ0ZXh0Q29udGVudCIsIkNvbnRyb2xsZXIiLCJhcHAiLCJzdGFydFN0aW11bHVzQXBwIiwicmVxdWlyZSIsImZha2VyIiwiYnRuIiwiZG9jdW1lbnQiLCJnZXRFbGVtZW50QnlJZCIsImlucHV0X2ZpZWxkIiwiYWRkRXZlbnRMaXN0ZW5lciIsImUiLCJwcmV2ZW50RGVmYXVsdCIsInZhbHVlIiwibWVudXMiLCJxdWVyeVNlbGVjdG9yQWxsIiwic2lkZWJhciIsImNvbnRlbnRMb2dvIiwibWVudSIsImNsYXNzTGlzdCIsImNvbnRhaW5zIiwicmVtb3ZlIiwiYWRkIiwic2hvd19idG4iLCJoaWRlX2J0biIsInFyX2NvbnRhaW5lciIsInVuZGVmaW5lZCIsInRvZ2dsZSJdLCJtYXBwaW5ncyI6Ijs7Ozs7Ozs7QUFBQTtBQUNBO0FBQ0E7OztBQUdBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQSwwSTs7Ozs7Ozs7Ozs7Ozs7O0FDdEJBLGlFQUFlO0FBQ2YsQ0FBQyxFOzs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7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QUExQjtBQUNILEdBSkQ7QUFLSDs7QUFFRCxJQUFJSCxRQUFRLEtBQUtFLFNBQWpCLEVBQ0E7QUFDSUYsVUFBUSxDQUFDZCxnQkFBVCxDQUEwQixPQUExQixFQUFtQyxVQUFDQyxDQUFELEVBQUs7QUFDcENjLGdCQUFZLENBQUNOLFNBQWIsQ0FBdUJRLE1BQXZCLENBQThCLE1BQTlCO0FBQ0FKLFlBQVEsQ0FBQ0osU0FBVCxDQUFtQlEsTUFBbkIsQ0FBMEIsTUFBMUI7QUFDQUgsWUFBUSxDQUFDTCxTQUFULENBQW1CUSxNQUFuQixDQUEwQixNQUExQjtBQUNILEdBSkQ7QUFLSCxDOzs7Ozs7Ozs7Ozs7QUNwQkQiLCJmaWxlIjoiYmFjay5qcyIsInNvdXJjZXNDb250ZW50IjpbInZhciBtYXAgPSB7XG5cdFwiLi9oZWxsb19jb250cm9sbGVyLmpzXCI6IFwiLi9ub2RlX21vZHVsZXMvQHN5bWZvbnkvc3RpbXVsdXMtYnJpZGdlL2xhenktY29udHJvbGxlci1sb2FkZXIuanMhLi9hc3NldHMvY29udHJvbGxlcnMvaGVsbG9fY29udHJvbGxlci5qc1wiXG59O1xuXG5cbmZ1bmN0aW9uIHdlYnBhY2tDb250ZXh0KHJlcSkge1xuXHR2YXIgaWQgPSB3ZWJwYWNrQ29udGV4dFJlc29sdmUocmVxKTtcblx0cmV0dXJuIF9fd2VicGFja19yZXF1aXJlX18oaWQpO1xufVxuZnVuY3Rpb24gd2VicGFja0NvbnRleHRSZXNvbHZlKHJlcSkge1xuXHRpZighX193ZWJwYWNrX3JlcXVpcmVfXy5vKG1hcCwgcmVxKSkge1xuXHRcdHZhciBlID0gbmV3IEVycm9yKFwiQ2Fubm90IGZpbmQgbW9kdWxlICdcIiArIHJlcSArIFwiJ1wiKTtcblx0XHRlLmNvZGUgPSAnTU9EVUxFX05PVF9GT1VORCc7XG5cdFx0dGhyb3cgZTtcblx0fVxuXHRyZXR1cm4gbWFwW3JlcV07XG59XG53ZWJwYWNrQ29udGV4dC5rZXlzID0gZnVuY3Rpb24gd2VicGFja0NvbnRleHRLZXlzKCkge1xuXHRyZXR1cm4gT2JqZWN0LmtleXMobWFwKTtcbn07XG53ZWJwYWNrQ29udGV4dC5yZXNvbHZlID0gd2VicGFja0NvbnRleHRSZXNvbHZlO1xubW9kdWxlLmV4cG9ydHMgPSB3ZWJwYWNrQ29udGV4dDtcbndlYnBhY2tDb250ZXh0LmlkID0gXCIuL2Fzc2V0cy9jb250cm9sbGVycyBzeW5jIHJlY3Vyc2l2ZSAuL25vZGVfbW9kdWxlcy9Ac3ltZm9ueS9zdGltdWx1cy1icmlkZ2UvbGF6eS1jb250cm9sbGVyLWxvYWRlci5qcyEgXFxcXC4oanx0KXN4PyRcIjsiLCJleHBvcnQgZGVmYXVsdCB7XG59OyIsImltcG9ydCB7IENvbnRyb2xsZXIgfSBmcm9tICdzdGltdWx1cyc7XG5cbi8qXG4gKiBUaGlzIGlzIGFuIGV4YW1wbGUgU3RpbXVsdXMgY29udHJvbGxlciFcbiAqXG4gKiBBbnkgZWxlbWVudCB3aXRoIGEgZGF0YS1jb250cm9sbGVyPVwiaGVsbG9cIiBhdHRyaWJ1dGUgd2lsbCBjYXVzZVxuICogdGhpcyBjb250cm9sbGVyIHRvIGJlIGV4ZWN1dGVkLiBUaGUgbmFtZSBcImhlbGxvXCIgY29tZXMgZnJvbSB0aGUgZmlsZW5hbWU6XG4gKiBoZWxsb19jb250cm9sbGVyLmpzIC0+IFwiaGVsbG9cIlxuICpcbiAqIERlbGV0ZSB0aGlzIGZpbGUgb3IgYWRhcHQgaXQgZm9yIHlvdXIgdXNlIVxuICovXG5leHBvcnQgZGVmYXVsdCBjbGFzcyBleHRlbmRzIENvbnRyb2xsZXIge1xuICAgIGNvbm5lY3QoKSB7XG4gICAgICAgIHRoaXMuZWxlbWVudC50ZXh0Q29udGVudCA9ICdIZWxsbyBTdGltdWx1cyEgRWRpdCBtZSBpbiBhc3NldHMvY29udHJvbGxlcnMvaGVsbG9fY29udHJvbGxlci5qcyc7XG4gICAgfVxufVxuIiwiLypcclxuICogV2VsY29tZSB0byB5b3VyIGFwcCdzIG1haW4gSmF2YVNjcmlwdCBmaWxlIVxyXG4gKlxyXG4gKiBXZSByZWNvbW1lbmQgaW5jbHVkaW5nIHRoZSBidWlsdCB2ZXJzaW9uIG9mIHRoaXMgSmF2YVNjcmlwdCBmaWxlXHJcbiAqIChhbmQgaXRzIENTUyBmaWxlKSBpbiB5b3VyIGJhc2UgbGF5b3V0IChiYXNlLmh0bWwudHdpZykuXHJcbiAqL1xyXG5cclxuLy8gYW55IENTUyB5b3UgaW1wb3J0IHdpbGwgb3V0cHV0IGludG8gYSBzaW5nbGUgY3NzIGZpbGUgKGFwcC5jc3MgaW4gdGhpcyBjYXNlKVxyXG5pbXBvcnQgJy4vc3R5bGVzL2JhY2suc2Nzcyc7XHJcblxyXG4vLyBzdGFydCB0aGUgU3RpbXVsdXMgYXBwbGljYXRpb25cclxuaW1wb3J0ICcuL2Jvb3RzdHJhcCc7XHJcblxyXG5pbXBvcnQgZmFrZXIgZnJvbSAnZmFrZXInO1xyXG5cclxuaW1wb3J0ICcuL2pzL3FyLWNvZGUnO1xyXG5pbXBvcnQgJy4vanMvZmFrZXInO1xyXG5pbXBvcnQgJy4vanMvbWFpbic7IiwiaW1wb3J0IHsgc3RhcnRTdGltdWx1c0FwcCB9IGZyb20gJ0BzeW1mb255L3N0aW11bHVzLWJyaWRnZSc7XG5cbi8vIFJlZ2lzdGVycyBTdGltdWx1cyBjb250cm9sbGVycyBmcm9tIGNvbnRyb2xsZXJzLmpzb24gYW5kIGluIHRoZSBjb250cm9sbGVycy8gZGlyZWN0b3J5XG5leHBvcnQgY29uc3QgYXBwID0gc3RhcnRTdGltdWx1c0FwcChyZXF1aXJlLmNvbnRleHQoXG4gICAgJ0BzeW1mb255L3N0aW11bHVzLWJyaWRnZS9sYXp5LWNvbnRyb2xsZXItbG9hZGVyIS4vY29udHJvbGxlcnMnLFxuICAgIHRydWUsXG4gICAgL1xcLihqfHQpc3g/JC9cbikpO1xuXG4vLyByZWdpc3RlciBhbnkgY3VzdG9tLCAzcmQgcGFydHkgY29udHJvbGxlcnMgaGVyZVxuLy8gYXBwLnJlZ2lzdGVyKCdzb21lX2NvbnRyb2xsZXJfbmFtZScsIFNvbWVJbXBvcnRlZENvbnRyb2xsZXIpO1xuIiwiXHJcbmltcG9ydCBmYWtlciBmcm9tICdmYWtlcic7XHJcblxyXG4vKioqKioqKioqKioqKioqL1xyXG4vKiBmYWtlcnMgICAgICAqL1xyXG4vKioqKioqKioqKioqKioqL1xyXG5mYWtlci5sb2NhbGU9ICdmcidcclxuXHJcbmNvbnN0IGJ0biAgPSBkb2N1bWVudC5nZXRFbGVtZW50QnlJZCgnZmFrZXJfYnV0dG9uJylcclxuY29uc3QgaW5wdXRfZmllbGQgID0gZG9jdW1lbnQuZ2V0RWxlbWVudEJ5SWQoJ3VybF91cmwnKVxyXG5cclxuYnRuLmFkZEV2ZW50TGlzdGVuZXIoJ2NsaWNrJywgKGUpPT57XHJcbiAgICBlLnByZXZlbnREZWZhdWx0KClcclxuICAgIGlucHV0X2ZpZWxkLnZhbHVlID0gZmFrZXIuaW50ZXJuZXQudXNlck5hbWUoKTtcclxufSlcclxuIiwiLyogKioqKioqKioqKioqKioqKioqKioqKioqKiAqL1xyXG4vKiAqKioqKiBMQVRFUkFMIE1FTlUgKioqKioqICovXHJcbi8qKioqKioqKioqKioqKioqKioqKioqKioqKioqL1xyXG5cclxudmFyIG1lbnVzID0gZG9jdW1lbnQucXVlcnlTZWxlY3RvckFsbChcIiNtZW51LCAjc2lkZWJhci1tZW51XCIpXHJcbnZhciBzaWRlYmFyID0gZG9jdW1lbnQuZ2V0RWxlbWVudEJ5SWQoXCJzaWRlYmFyXCIpXHJcbnZhciBjb250ZW50TG9nbyA9IGRvY3VtZW50LmdldEVsZW1lbnRCeUlkKCdjb250ZW50LWxvZ28nKVxyXG5cclxuZm9yICh2YXIgbWVudSBvZiBtZW51cykge1xyXG4gICAgbWVudS5hZGRFdmVudExpc3RlbmVyKCdjbGljaycsICgpID0+IHtcclxuICAgICAgICBpZiAoc2lkZWJhci5jbGFzc0xpc3QuY29udGFpbnMoJ3Nob3cnKSkge1xyXG4gICAgICAgICAgICBzaWRlYmFyLmNsYXNzTGlzdC5yZW1vdmUoJ3Nob3cnKVxyXG4gICAgICAgICAgICBpZiAoY29udGVudExvZ28uY2xhc3NMaXN0LmNvbnRhaW5zKCdoaWRlJykpIHtcclxuICAgICAgICAgICAgICAgIGNvbnRlbnRMb2dvLmNsYXNzTGlzdC5yZW1vdmUoJ2hpZGUnKVxyXG4gICAgICAgICAgICB9XHJcbiAgICAgICAgfSBlbHNlIHtcclxuICAgICAgICAgICAgc2lkZWJhci5jbGFzc0xpc3QuYWRkKCdzaG93JylcclxuICAgICAgICAgICAgaWYgKCFjb250ZW50TG9nby5jbGFzc0xpc3QuY29udGFpbnMoJ2hpZGUnKSkge1xyXG4gICAgICAgICAgICAgICAgY29udGVudExvZ28uY2xhc3NMaXN0LmFkZCgnaGlkZScpXHJcbiAgICAgICAgICAgIH1cclxuXHJcbiAgICAgICAgfVxyXG4gICAgfSlcclxufVxyXG5cclxuXHJcbiIsImNvbnN0IHNob3dfYnRuID0gZG9jdW1lbnQuZ2V0RWxlbWVudEJ5SWQoJ3FyLWN0YS1zaG93JylcclxuY29uc3QgaGlkZV9idG4gPSBkb2N1bWVudC5nZXRFbGVtZW50QnlJZCgncXItY3RhLWhpZGUnKVxyXG5jb25zdCBxcl9jb250YWluZXIgPSBkb2N1bWVudC5nZXRFbGVtZW50QnlJZCgncXItY3RhJylcclxuXHJcbmlmIChzaG93X2J0biAhPT0gdW5kZWZpbmVkKVxyXG57XHJcbiAgICBzaG93X2J0bi5hZGRFdmVudExpc3RlbmVyKCdjbGljaycsIChlKT0+e1xyXG4gICAgICAgIHFyX2NvbnRhaW5lci5jbGFzc0xpc3QuYWRkKCdzaG93JylcclxuICAgICAgICBzaG93X2J0bi5jbGFzc0xpc3QuYWRkKCdoaWRlJylcclxuICAgICAgICBoaWRlX2J0bi5jbGFzc0xpc3QudG9nZ2xlKCdoaWRlJylcclxuICAgIH0pXHJcbn1cclxuXHJcbmlmIChoaWRlX2J0biAhPT0gdW5kZWZpbmVkKVxyXG57XHJcbiAgICBoaWRlX2J0bi5hZGRFdmVudExpc3RlbmVyKCdjbGljaycsIChlKT0+e1xyXG4gICAgICAgIHFyX2NvbnRhaW5lci5jbGFzc0xpc3QudG9nZ2xlKCdzaG93JylcclxuICAgICAgICBzaG93X2J0bi5jbGFzc0xpc3QudG9nZ2xlKCdoaWRlJylcclxuICAgICAgICBoaWRlX2J0bi5jbGFzc0xpc3QudG9nZ2xlKCdoaWRlJylcclxuICAgIH0pXHJcbn1cclxuXHJcbiIsIi8vIGV4dHJhY3RlZCBieSBtaW5pLWNzcy1leHRyYWN0LXBsdWdpblxuZXhwb3J0IHt9OyJdLCJzb3VyY2VSb290IjoiIn0=