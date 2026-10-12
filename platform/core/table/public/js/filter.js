/******/ (() => { // webpackBootstrap
/*!***********************************************************!*\
  !*** ./platform/core/table/resources/assets/js/filter.js ***!
  \***********************************************************/
function _typeof(o) { "@babel/helpers - typeof"; return _typeof = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function (o) { return typeof o; } : function (o) { return o && "function" == typeof Symbol && o.constructor === Symbol && o !== Symbol.prototype ? "symbol" : typeof o; }, _typeof(o); }
function _classCallCheck(a, n) { if (!(a instanceof n)) throw new TypeError("Cannot call a class as a function"); }
function _defineProperties(e, r) { for (var t = 0; t < r.length; t++) { var o = r[t]; o.enumerable = o.enumerable || !1, o.configurable = !0, "value" in o && (o.writable = !0), Object.defineProperty(e, _toPropertyKey(o.key), o); } }
function _createClass(e, r, t) { return r && _defineProperties(e.prototype, r), t && _defineProperties(e, t), Object.defineProperty(e, "prototype", { writable: !1 }), e; }
function _toPropertyKey(t) { var i = _toPrimitive(t, "string"); return "symbol" == _typeof(i) ? i : i + ""; }
function _toPrimitive(t, e) { if ("object" != _typeof(t) || !t) return t; var r; if ("undefined" != typeof Symbol && void 0 !== (r = t[Symbol.toPrimitive])) { var i = r.call(t, e || "default"); if ("object" != _typeof(i)) return i; throw new TypeError("@@toPrimitive must return a primitive value."); } return ("string" === e ? String : Number)(t); }
var TableFilter = /*#__PURE__*/function () {
  function TableFilter() {
    _classCallCheck(this, TableFilter);
  }
  return _createClass(TableFilter, [{
    key: "loadData",
    value: function loadData($element) {
      $.ajax({
        type: 'GET',
        url: $('.filter-data-url').val(),
        data: {
          "class": $('.filter-data-class').val(),
          key: $element.val(),
          value: $element.closest('.filter-item').find('.filter-column-value').val()
        },
        success: function success(res) {
          var data = $.map(res.data, function (value, key) {
            return {
              id: key,
              name: value
            };
          });
          $element.closest('.filter-item').find('.filter-column-value-wrap').html(res.html);
          var $input = $element.closest('.filter-item').find('.filter-column-value');
          if ($input.length && $input.prop('type') === 'text') {
            $input.typeahead({
              source: data
            });
            $input.data('typeahead').source = data;
          }
          Cms.initResources();
        },
        error: function error(_error) {
          Cms.handleError(_error);
        }
      });
    }
  }, {
    key: "init",
    value: function init() {
      var that = this;
      $.each($('.filter-items-wrap .filter-column-key'), function (index, element) {
        if ($(element).val()) {
          that.loadData($(element));
        }
      });
      $(document).on('change', '.filter-column-key', function (event) {
        that.loadData($(event.currentTarget));
      });
      $(document).on('click', '.btn-reset-filter-item', function (event) {
        event.preventDefault();
        var _self = $(event.currentTarget);
        _self.closest('.filter-item').find('.filter-column-key').val('').trigger('change');
        _self.closest('.filter-item').find('.filter-column-operator').val('=');
        _self.closest('.filter-item').find('.filter-column-value').val('');
      });
      $(document).on('click', '.add-more-filter', function () {
        var $template = $(document).find('.sample-filter-item-wrap');
        var html = $template.html();
        $(document).find('.filter-items-wrap').append(html.replace('<script>', '').replace('<\\/script>', ''));
        Cms.initResources();
        var element = $(document).find('.filter-items-wrap .filter-item:last-child').find('.filter-column-key');
        if ($(element).val()) {
          that.loadData(element);
        }
      });
      $(document).on('click', '.btn-remove-filter-item', function (event) {
        event.preventDefault();
        $(event.currentTarget).closest('.filter-item').remove();
      });
    }
  }]);
}();
$(document).ready(function () {
  new TableFilter().init();
});
/******/ })()
;