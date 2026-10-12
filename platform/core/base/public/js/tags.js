/******/ (() => { // webpackBootstrap
/*!********************************************************!*\
  !*** ./platform/core/base/resources/assets/js/tags.js ***!
  \********************************************************/
function _typeof(o) { "@babel/helpers - typeof"; return _typeof = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function (o) { return typeof o; } : function (o) { return o && "function" == typeof Symbol && o.constructor === Symbol && o !== Symbol.prototype ? "symbol" : typeof o; }, _typeof(o); }
function _classCallCheck(a, n) { if (!(a instanceof n)) throw new TypeError("Cannot call a class as a function"); }
function _defineProperties(e, r) { for (var t = 0; t < r.length; t++) { var o = r[t]; o.enumerable = o.enumerable || !1, o.configurable = !0, "value" in o && (o.writable = !0), Object.defineProperty(e, _toPropertyKey(o.key), o); } }
function _createClass(e, r, t) { return r && _defineProperties(e.prototype, r), t && _defineProperties(e, t), Object.defineProperty(e, "prototype", { writable: !1 }), e; }
function _toPropertyKey(t) { var i = _toPrimitive(t, "string"); return "symbol" == _typeof(i) ? i : i + ""; }
function _toPrimitive(t, e) { if ("object" != _typeof(t) || !t) return t; var r; if ("undefined" != typeof Symbol && void 0 !== (r = t[Symbol.toPrimitive])) { var i = r.call(t, e || "default"); if ("object" != _typeof(i)) return i; throw new TypeError("@@toPrimitive must return a primitive value."); } return ("string" === e ? String : Number)(t); }
var TagsManager = /*#__PURE__*/function () {
  function TagsManager() {
    _classCallCheck(this, TagsManager);
  }
  return _createClass(TagsManager, [{
    key: "init",
    value: function init() {
      $(document).find('.tags').each(function (index, element) {
        var tagify = new Tagify(element, {
          keepInvalidTags: $(element).data('keep-invalid-tags') !== undefined ? $(element).data('keep-invalid-tags') : true,
          enforceWhitelist: $(element).data('enforce-whitelist') !== undefined ? $(element).data('enforce-whitelist') : false,
          delimiters: $(element).data('delimiters') !== undefined ? $(element).data('delimiters') : ',',
          whitelist: element.value.trim().split(/\s*,\s*/)
        });
        if ($(element).data('url')) {
          tagify.on('input', function (e) {
            tagify.settings.whitelist.length = 0; // reset current whitelist
            tagify.loading(true).dropdown.hide.call(tagify); // show the loader animation

            $.ajax({
              type: 'GET',
              url: $(element).data('url'),
              success: function success(data) {
                tagify.settings.whitelist = data;

                // render the suggestions dropdown.
                tagify.loading(false).dropdown.show.call(tagify, e.detail.value);
              }
            });
          });
        }
      });
    }
  }]);
}();
$(document).ready(function () {
  new TagsManager().init();
});
/******/ })()
;