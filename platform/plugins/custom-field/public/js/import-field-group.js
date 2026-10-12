/******/ (() => { // webpackBootstrap
/******/ 	"use strict";
/******/ 	// The require scope
/******/ 	const __webpack_require__ = {};
/******/ 	
/************************************************************************/
/******/ 	/* webpack/runtime/define property getters */
/******/ 	// define getter/value functions for harmony exports
/******/ 	__webpack_require__.d = (exports, definition) => {
/******/ 		for(var key in definition) {
/******/ 			if(__webpack_require__.o(definition, key) && !__webpack_require__.o(exports, key)) {
/******/ 				Object.defineProperty(exports, key, { enumerable: true, get: definition[key] });
/******/ 			}
/******/ 		}
/******/ 	};
/******/ 	
/******/ 	/* webpack/runtime/hasOwnProperty shorthand */
/******/ 	__webpack_require__.o = (obj, prop) => (Object.prototype.hasOwnProperty.call(obj, prop));
/******/ 	
/******/ 	/* webpack/runtime/make namespace object */
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = (exports) => {
/******/ 		Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/ 	
/************************************************************************/
let __webpack_exports__ = {};
/*!*********************************************************************************!*\
  !*** ./platform/plugins/custom-field/resources/assets/js/import-field-group.js ***!
  \*********************************************************************************/
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   Helpers: () => (/* binding */ Helpers)
/* harmony export */ });
function _typeof(o) { "@babel/helpers - typeof"; return _typeof = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function (o) { return typeof o; } : function (o) { return o && "function" == typeof Symbol && o.constructor === Symbol && o !== Symbol.prototype ? "symbol" : typeof o; }, _typeof(o); }
function _classCallCheck(a, n) { if (!(a instanceof n)) throw new TypeError("Cannot call a class as a function"); }
function _defineProperties(e, r) { for (var t = 0; t < r.length; t++) { var o = r[t]; o.enumerable = o.enumerable || !1, o.configurable = !0, "value" in o && (o.writable = !0), Object.defineProperty(e, _toPropertyKey(o.key), o); } }
function _createClass(e, r, t) { return r && _defineProperties(e.prototype, r), t && _defineProperties(e, t), Object.defineProperty(e, "prototype", { writable: !1 }), e; }
function _toPropertyKey(t) { var i = _toPrimitive(t, "string"); return "symbol" == _typeof(i) ? i : i + ""; }
function _toPrimitive(t, e) { if ("object" != _typeof(t) || !t) return t; var r; if ("undefined" != typeof Symbol && void 0 !== (r = t[Symbol.toPrimitive])) { var i = r.call(t, e || "default"); if ("object" != _typeof(i)) return i; throw new TypeError("@@toPrimitive must return a primitive value."); } return ("string" === e ? String : Number)(t); }
var Helpers = /*#__PURE__*/function () {
  function Helpers() {
    _classCallCheck(this, Helpers);
  }
  return _createClass(Helpers, null, [{
    key: "jsonDecode",
    value: function jsonDecode(jsonString, defaultValue) {
      if (typeof jsonString === 'string') {
        var result;
        try {
          result = $.parseJSON(jsonString);
        } catch (err) {
          result = defaultValue;
        }
        return result;
      }
      return null;
    }
  }]);
}();
(function ($) {
  var $body = $('body');
  $body.on('click', 'form.import-field-group button.btn.btn-secondary.action-item:nth-child(2)', function (event) {
    event.preventDefault();
    event.stopPropagation();
    var $form = $(event.currentTarget).closest('form');
    $form.find('input[type=file]').val('').trigger('click');
  });
  $body.on('change', 'form.import-field-group input[type=file]', function (event) {
    var $form = $(event.currentTarget).closest('form');
    var file = event.currentTarget.files[0];
    if (file) {
      var reader = new FileReader();
      reader.readAsText(file);
      reader.onload = function (e) {
        var json = Helpers.jsonDecode(e.target.result);
        $.ajax({
          url: $form.attr('action'),
          type: 'POST',
          data: {
            json_data: json
          },
          dataType: 'json',
          beforeSend: function beforeSend() {
            Cms.blockUI();
          },
          success: function success(res) {
            Cms.showNotice(res.error ? 'error' : 'success', res.messages);
            if (!res.error) {
              if (window.LaravelDataTables['table-custom-fields']) {
                window.LaravelDataTables['table-custom-fields'].draw();
              }
            }
            Cms.unblockUI();
          },
          complete: function complete() {
            Cms.unblockUI();
          },
          error: function error() {
            Cms.showError('Some error occurred');
          }
        });
      };
    }
  });
})(jQuery);
/******/ })()
;