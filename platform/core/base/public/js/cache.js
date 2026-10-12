/******/ (() => { // webpackBootstrap
/*!*********************************************************!*\
  !*** ./platform/core/base/resources/assets/js/cache.js ***!
  \*********************************************************/
function _typeof(o) { "@babel/helpers - typeof"; return _typeof = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function (o) { return typeof o; } : function (o) { return o && "function" == typeof Symbol && o.constructor === Symbol && o !== Symbol.prototype ? "symbol" : typeof o; }, _typeof(o); }
function _classCallCheck(a, n) { if (!(a instanceof n)) throw new TypeError("Cannot call a class as a function"); }
function _defineProperties(e, r) { for (var t = 0; t < r.length; t++) { var o = r[t]; o.enumerable = o.enumerable || !1, o.configurable = !0, "value" in o && (o.writable = !0), Object.defineProperty(e, _toPropertyKey(o.key), o); } }
function _createClass(e, r, t) { return r && _defineProperties(e.prototype, r), t && _defineProperties(e, t), Object.defineProperty(e, "prototype", { writable: !1 }), e; }
function _toPropertyKey(t) { var i = _toPrimitive(t, "string"); return "symbol" == _typeof(i) ? i : i + ""; }
function _toPrimitive(t, e) { if ("object" != _typeof(t) || !t) return t; var r; if ("undefined" != typeof Symbol && void 0 !== (r = t[Symbol.toPrimitive])) { var i = r.call(t, e || "default"); if ("object" != _typeof(i)) return i; throw new TypeError("@@toPrimitive must return a primitive value."); } return ("string" === e ? String : Number)(t); }
var CacheManagement = /*#__PURE__*/function () {
  function CacheManagement() {
    _classCallCheck(this, CacheManagement);
  }
  return _createClass(CacheManagement, [{
    key: "init",
    value: function init() {
      $(document).on('click', '.btn-clear-cache', function (event) {
        event.preventDefault();
        var _self = $(event.currentTarget);
        _self.addClass('button-loading');
        $.ajax({
          url: _self.data('url'),
          type: 'POST',
          data: {
            type: _self.data('type')
          },
          success: function success(data) {
            _self.removeClass('button-loading');
            if (data.error) {
              Cms.showError(data.message);
            } else {
              Cms.showSuccess(data.message);
            }
          },
          error: function error(data) {
            _self.removeClass('button-loading');
            Cms.handleError(data);
          }
        });
      });
    }
  }]);
}();
$(document).ready(function () {
  new CacheManagement().init();
});
/******/ })()
;