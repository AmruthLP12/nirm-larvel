/******/ (() => { // webpackBootstrap
/*!**************************************************************************!*\
  !*** ./platform/plugins/language/resources/assets/js/language-global.js ***!
  \**************************************************************************/
function _typeof(o) { "@babel/helpers - typeof"; return _typeof = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function (o) { return typeof o; } : function (o) { return o && "function" == typeof Symbol && o.constructor === Symbol && o !== Symbol.prototype ? "symbol" : typeof o; }, _typeof(o); }
function _classCallCheck(a, n) { if (!(a instanceof n)) throw new TypeError("Cannot call a class as a function"); }
function _defineProperties(e, r) { for (var t = 0; t < r.length; t++) { var o = r[t]; o.enumerable = o.enumerable || !1, o.configurable = !0, "value" in o && (o.writable = !0), Object.defineProperty(e, _toPropertyKey(o.key), o); } }
function _createClass(e, r, t) { return r && _defineProperties(e.prototype, r), t && _defineProperties(e, t), Object.defineProperty(e, "prototype", { writable: !1 }), e; }
function _toPropertyKey(t) { var i = _toPrimitive(t, "string"); return "symbol" == _typeof(i) ? i : i + ""; }
function _toPrimitive(t, e) { if ("object" != _typeof(t) || !t) return t; var r; if ("undefined" != typeof Symbol && void 0 !== (r = t[Symbol.toPrimitive])) { var i = r.call(t, e || "default"); if ("object" != _typeof(i)) return i; throw new TypeError("@@toPrimitive must return a primitive value."); } return ("string" === e ? String : Number)(t); }
var LanguageGlobalManagement = /*#__PURE__*/function () {
  function LanguageGlobalManagement() {
    _classCallCheck(this, LanguageGlobalManagement);
  }
  return _createClass(LanguageGlobalManagement, [{
    key: "init",
    value: function init() {
      var languageChoiceSelect = $('#post_lang_choice');
      languageChoiceSelect.data('prev', languageChoiceSelect.val());
      $(document).on('change', '#post_lang_choice', function (event) {
        $('.change_to_language_text').text($(event.currentTarget).find('option:selected').text());
        $('#confirm-change-language-modal').modal('show');
      });
      $(document).on('click', '#confirm-change-language-modal .btn-warning.float-left', function (event) {
        event.preventDefault();
        languageChoiceSelect = $('#post_lang_choice');
        languageChoiceSelect.val(languageChoiceSelect.data('prev')).trigger('change');
        $('#confirm-change-language-modal').modal('hide');
      });
      $(document).on('click', '#confirm-change-language-button', function (event) {
        event.preventDefault();
        var _self = $(event.currentTarget);
        var flagPath = $('#language_flag_path').val();
        _self.addClass('button-loading');
        languageChoiceSelect = $('#post_lang_choice');
        $.ajax({
          url: $('div[data-change-language-route]').data('change-language-route'),
          data: {
            lang_meta_current_language: languageChoiceSelect.val(),
            reference_id: $('#reference_id').val(),
            reference_type: $('#reference_type').val(),
            lang_meta_created_from: $('#lang_meta_created_from').val()
          },
          type: 'POST',
          success: function success(data) {
            $('.active-language').html('<img src="' + flagPath + languageChoiceSelect.find('option:selected').data('flag') + '.svg" width="16" title="' + languageChoiceSelect.find('option:selected').text() + '" alt="' + languageChoiceSelect.find('option:selected').text() + '" />');
            if (!data.error) {
              $('.current_language_text').text(languageChoiceSelect.find('option:selected').text());
              var html = '';
              $.each(data.data, function (index, el) {
                html += '<img src="' + flagPath + el.lang_flag + '.svg" width="16" title="' + el.lang_name + '" alt="' + el.lang_name + '">';
                if (el.reference_id) {
                  html += '<a href="' + $('#route_edit').val() + '"> ' + el.lang_name + ' <i class="fa fa-edit"></i> </a><br />';
                } else {
                  html += '<a href="' + $('#route_create').val() + '?ref_from=' + $('#content_id').val() + '&ref_lang=' + index + '"> ' + el.lang_name + ' <i class="fa fa-plus"></i> </a><br />';
                }
              });
              $('#list-others-language').html(html);
              $('#confirm-change-language-modal').modal('hide');
              languageChoiceSelect.data('prev', languageChoiceSelect.val()).trigger('change');
            }
            _self.removeClass('button-loading');
          },
          error: function error(data) {
            Cms.showError(data.message);
            _self.removeClass('button-loading');
          }
        });
      });
      $(document).on('click', '.change-data-language-item', function (event) {
        event.preventDefault();
        window.location.href = $(event.currentTarget).find('span[data-href]').data('href');
      });
    }
  }]);
}();
;
$(document).ready(function () {
  new LanguageGlobalManagement().init();
  $.ajaxSetup({
    data: {
      'ref_from': $('meta[name="ref_from"]').attr('content'),
      'ref_lang': $('meta[name="ref_lang"]').attr('content')
    }
  });
});
/******/ })()
;