/******/ (() => { // webpackBootstrap
/*!************************************************************!*\
  !*** ./platform/packages/slug/resources/assets/js/slug.js ***!
  \************************************************************/
function _typeof(o) { "@babel/helpers - typeof"; return _typeof = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function (o) { return typeof o; } : function (o) { return o && "function" == typeof Symbol && o.constructor === Symbol && o !== Symbol.prototype ? "symbol" : typeof o; }, _typeof(o); }
function _classCallCheck(a, n) { if (!(a instanceof n)) throw new TypeError("Cannot call a class as a function"); }
function _defineProperties(e, r) { for (var t = 0; t < r.length; t++) { var o = r[t]; o.enumerable = o.enumerable || !1, o.configurable = !0, "value" in o && (o.writable = !0), Object.defineProperty(e, _toPropertyKey(o.key), o); } }
function _createClass(e, r, t) { return r && _defineProperties(e.prototype, r), t && _defineProperties(e, t), Object.defineProperty(e, "prototype", { writable: !1 }), e; }
function _toPropertyKey(t) { var i = _toPrimitive(t, "string"); return "symbol" == _typeof(i) ? i : i + ""; }
function _toPrimitive(t, e) { if ("object" != _typeof(t) || !t) return t; var r; if ("undefined" != typeof Symbol && void 0 !== (r = t[Symbol.toPrimitive])) { var i = r.call(t, e || "default"); if ("object" != _typeof(i)) return i; throw new TypeError("@@toPrimitive must return a primitive value."); } return ("string" === e ? String : Number)(t); }
var SlugBoxManagement = /*#__PURE__*/function () {
  function SlugBoxManagement() {
    _classCallCheck(this, SlugBoxManagement);
  }
  return _createClass(SlugBoxManagement, [{
    key: "init",
    value: function init() {
      $(document).on('click', '#change_slug', function (event) {
        $('.default-slug').unwrap();
        var $slug_input = $('#editable-post-name');
        $slug_input.html('<input type="text" id="new-post-slug" class="form-control" value="' + $slug_input.text() + '" autocomplete="off">');
        $('#edit-slug-box .cancel').show();
        $('#edit-slug-box .save').show();
        $(event.currentTarget).hide();
      });
      $(document).on('click', '#edit-slug-box .cancel', function () {
        var currentSlug = $('#current-slug').val();
        var $permalink = $('#sample-permalink');
        $permalink.html('<a class="permalink" href="' + $('#slug_id').data('view') + currentSlug.replace('/', '') + '">' + $permalink.html() + '</a>');
        $('#editable-post-name').text(currentSlug);
        $('#edit-slug-box .cancel').hide();
        $('#edit-slug-box .save').hide();
        $('#change_slug').show();
      });
      var createSlug = function createSlug(name, id, exist) {
        $.ajax({
          url: $('#slug_id').data('url'),
          type: 'POST',
          data: {
            name: name,
            slug_id: id,
            model: $('input[name=model]').val()
          },
          success: function success(data) {
            var $permalink = $('#sample-permalink');
            var $slug_id = $('#slug_id');
            if (exist) {
              $permalink.find('.permalink').prop('href', $slug_id.data('view') + data.replace('/', ''));
            } else {
              $permalink.html('<a class="permalink" target="_blank" href="' + $slug_id.data('view') + data.replace('/', '') + '">' + $permalink.html() + '</a>');
            }
            $('.page-url-seo p').text($slug_id.data('view') + data.replace('/', ''));
            $('#editable-post-name').text(data);
            $('#current-slug').val(data);
            $('#edit-slug-box .cancel').hide();
            $('#edit-slug-box .save').hide();
            $('#change_slug').show();
            $('#edit-slug-box').removeClass('hidden');
          },
          error: function error(data) {
            Cms.handleError(data);
          }
        });
      };
      $(document).on('click', '#edit-slug-box .save', function () {
        var $post_slug = $('#new-post-slug');
        var name = $post_slug.val();
        var id = $('#slug_id').data('id');
        if (id == null) {
          id = 0;
        }
        if (name != null && name !== '') {
          createSlug(name, id, false);
        } else {
          $post_slug.closest('.form-group').addClass('has-error');
        }
      });
      $(document).on('blur', '#name', function (e) {
        if ($('#edit-slug-box').hasClass('hidden')) {
          var name = $(e.currentTarget).val();
          if (name !== null && name !== '') {
            createSlug(name, 0, true);
          }
        }
      });
    }
  }]);
}();
$(function () {
  new SlugBoxManagement().init();
});
/******/ })()
;