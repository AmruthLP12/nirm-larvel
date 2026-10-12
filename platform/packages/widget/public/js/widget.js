/******/ (() => { // webpackBootstrap
/*!****************************************************************!*\
  !*** ./platform/packages/widget/resources/assets/js/widget.js ***!
  \****************************************************************/
function _typeof(o) { "@babel/helpers - typeof"; return _typeof = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function (o) { return typeof o; } : function (o) { return o && "function" == typeof Symbol && o.constructor === Symbol && o !== Symbol.prototype ? "symbol" : typeof o; }, _typeof(o); }
function _classCallCheck(a, n) { if (!(a instanceof n)) throw new TypeError("Cannot call a class as a function"); }
function _defineProperties(e, r) { for (var t = 0; t < r.length; t++) { var o = r[t]; o.enumerable = o.enumerable || !1, o.configurable = !0, "value" in o && (o.writable = !0), Object.defineProperty(e, _toPropertyKey(o.key), o); } }
function _createClass(e, r, t) { return r && _defineProperties(e.prototype, r), t && _defineProperties(e, t), Object.defineProperty(e, "prototype", { writable: !1 }), e; }
function _toPropertyKey(t) { var i = _toPrimitive(t, "string"); return "symbol" == _typeof(i) ? i : i + ""; }
function _toPrimitive(t, e) { if ("object" != _typeof(t) || !t) return t; var r; if ("undefined" != typeof Symbol && void 0 !== (r = t[Symbol.toPrimitive])) { var i = r.call(t, e || "default"); if ("object" != _typeof(i)) return i; throw new TypeError("@@toPrimitive must return a primitive value."); } return ("string" === e ? String : Number)(t); }
var WidgetManagement = /*#__PURE__*/function () {
  function WidgetManagement() {
    _classCallCheck(this, WidgetManagement);
  }
  return _createClass(WidgetManagement, [{
    key: "init",
    value: function init() {
      var listWidgets = [{
        name: 'wrap-widgets',
        pull: 'clone',
        put: false
      }];
      $.each($('.sidebar-item'), function () {
        listWidgets.push({
          name: 'wrap-widgets',
          pull: true,
          put: true
        });
      });
      var saveWidget = function saveWidget(parentElement) {
        if (parentElement.length > 0) {
          var items = [];
          $.each(parentElement.find('li[data-id]'), function (index, widget) {
            items.push($(widget).find('form').serialize());
          });
          $.ajax({
            type: 'POST',
            cache: false,
            url: BWidget.routes.save_widgets_sidebar,
            data: {
              items: items,
              sidebar_id: parentElement.data('id')
            },
            beforeSend: function beforeSend() {
              Cms.showNotice('info', CMSVariables.languages.notices_msg.processing_request);
            },
            success: function success(data) {
              if (data.error) {
                Cms.showError(data.message);
              } else {
                parentElement.find('ul').html(data.data);
                Cms.callScroll($('.list-page-select-widget'));
                Cms.initResources();
                Cms.initMediaIntegrate();
                Cms.showSuccess(data.message);
              }
              parentElement.find('.widget_save i').remove();
            },
            error: function error(data) {
              Cms.handleError(data);
              parentElement.find('.widget_save i').remove();
            }
          });
        }
      };
      listWidgets.forEach(function (groupOpts, i) {
        Sortable.create(document.getElementById('wrap-widget-' + (i + 1)), {
          sort: i !== 0,
          group: groupOpts,
          delay: 0,
          // time in milliseconds to define when the sorting should start
          disabled: false,
          // Disables the sortable if set to true.
          store: null,
          // @see Store
          animation: 150,
          // ms, animation speed moving items when sorting, `0` — without animation
          handle: '.widget-handle',
          ghostClass: 'sortable-ghost',
          // Class name for the drop placeholder
          chosenClass: 'sortable-chosen',
          // Class name for the chosen item
          dataIdAttr: 'data-id',
          forceFallback: false,
          // ignore the HTML5 DnD behaviour and force the fallback to kick in
          fallbackClass: 'sortable-fallback',
          // Class name for the cloned DOM Element when using forceFallback
          fallbackOnBody: false,
          // Appends the cloned DOM Element into the Document's Body

          scroll: true,
          // or HTMLElement
          scrollSensitivity: 30,
          // px, how near the mouse must be to an edge to start scrolling.
          scrollSpeed: 10,
          // px

          // dragging ended
          onEnd: function onEnd(evt) {
            if (evt.from !== evt.to) {
              saveWidget($(evt.from).closest('.sidebar-item'));
            }
            saveWidget($(evt.item).closest('.sidebar-item'));
          }
        });
      });
      var widgetWrap = $('#wrap-widgets');
      widgetWrap.on('click', '.widget-control-delete', function (event) {
        event.preventDefault();
        var _self = $(event.currentTarget);
        var widget = _self.closest('li');
        _self.addClass('button-loading');
        $.ajax({
          type: 'DELETE',
          cache: false,
          url: BWidget.routes["delete"],
          data: {
            widget_id: widget.data('id'),
            position: widget.data('position'),
            sidebar_id: _self.closest('.sidebar-item').data('id')
          },
          beforeSend: function beforeSend() {
            Cms.showNotice('info', CMSVariables.languages.notices_msg.processing_request);
          },
          success: function success(data) {
            if (data.error) {
              Cms.showError(data.message);
            } else {
              Cms.showSuccess(data.message);
              widget.fadeOut().remove();
            }
            widget.find('.widget-control-delete').removeClass('button-loading');
          },
          error: function error(data) {
            Cms.handleError(data);
            widget.find('.widget-control-delete').removeClass('button-loading');
          }
        });
      });
      widgetWrap.on('click', '#added-widget .widget-handle', function (event) {
        var _self = $(event.currentTarget);
        _self.closest('li').find('.widget-content').slideToggle(300);
        _self.find('.fa').toggleClass('fa-caret-up');
        _self.find('.fa').toggleClass('fa-caret-down');
      });
      widgetWrap.on('click', '.widget_save', function (event) {
        event.preventDefault();
        var _self = $(event.currentTarget);
        _self.addClass('button-loading');
        saveWidget(_self.closest('.sidebar-item'));
      });
      Cms.callScroll($('.list-page-select-widget'));
    }
  }]);
}();
$(document).ready(function () {
  new WidgetManagement().init();
});
/******/ })()
;