/******/ (() => { // webpackBootstrap
/*!***************************************************************!*\
  !*** ./platform/plugins/backup/resources/assets/js/backup.js ***!
  \***************************************************************/
function _typeof(o) { "@babel/helpers - typeof"; return _typeof = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function (o) { return typeof o; } : function (o) { return o && "function" == typeof Symbol && o.constructor === Symbol && o !== Symbol.prototype ? "symbol" : typeof o; }, _typeof(o); }
function _classCallCheck(a, n) { if (!(a instanceof n)) throw new TypeError("Cannot call a class as a function"); }
function _defineProperties(e, r) { for (var t = 0; t < r.length; t++) { var o = r[t]; o.enumerable = o.enumerable || !1, o.configurable = !0, "value" in o && (o.writable = !0), Object.defineProperty(e, _toPropertyKey(o.key), o); } }
function _createClass(e, r, t) { return r && _defineProperties(e.prototype, r), t && _defineProperties(e, t), Object.defineProperty(e, "prototype", { writable: !1 }), e; }
function _toPropertyKey(t) { var i = _toPrimitive(t, "string"); return "symbol" == _typeof(i) ? i : i + ""; }
function _toPrimitive(t, e) { if ("object" != _typeof(t) || !t) return t; var r; if ("undefined" != typeof Symbol && void 0 !== (r = t[Symbol.toPrimitive])) { var i = r.call(t, e || "default"); if ("object" != _typeof(i)) return i; throw new TypeError("@@toPrimitive must return a primitive value."); } return ("string" === e ? String : Number)(t); }
var BackupManagement = /*#__PURE__*/function () {
  function BackupManagement() {
    _classCallCheck(this, BackupManagement);
  }
  return _createClass(BackupManagement, [{
    key: "init",
    value: function init() {
      var table_backup = $('#table-backups');
      table_backup.on('click', '.deleteDialog', function (event) {
        event.preventDefault();
        $('.delete-crud-entry').data('section', $(event.currentTarget).data('section'));
        $('.modal-confirm-delete').modal('show');
      });
      table_backup.on('click', '.restoreBackup', function (event) {
        event.preventDefault();
        $('#restore-backup-button').data('section', $(event.currentTarget).data('section'));
        $('#restore-backup-modal').modal('show');
      });
      $('.delete-crud-entry').on('click', function (event) {
        event.preventDefault();
        $('.modal-confirm-delete').modal('hide');
        var deleteURL = $(event.currentTarget).data('section');
        $.ajax({
          url: deleteURL,
          type: 'DELETE',
          success: function success(data) {
            if (data.error) {
              Cms.showError(data.message);
            } else {
              table_backup.find('a[data-section="' + deleteURL + '"]').closest('tr').remove();
              Cms.showSuccess(data.message);
            }
          },
          error: function error(data) {
            Cms.handleError(data);
          }
        });
      });
      $('#restore-backup-button').on('click', function (event) {
        event.preventDefault();
        var _self = $(event.currentTarget);
        _self.addClass('button-loading');
        $.ajax({
          url: _self.data('section'),
          type: 'GET',
          success: function success(data) {
            _self.removeClass('button-loading');
            _self.closest('.modal').modal('hide');
            if (data.error) {
              Cms.showError(data.message);
            } else {
              Cms.showSuccess(data.message);
              window.location.reload();
            }
          },
          error: function error(data) {
            _self.removeClass('button-loading');
            Cms.handleError(data);
          }
        });
      });
      $(document).on('click', '#generate_backup', function (event) {
        event.preventDefault();
        $('#name').val('');
        $('#description').val('');
        $('#create-backup-modal').modal('show');
      });
      $('#create-backup-modal').on('click', '#create-backup-button', function (event) {
        event.preventDefault();
        var _self = $(event.currentTarget);
        _self.addClass('button-loading');
        var name = $('#name').val();
        var description = $('#description').val();
        var error = false;
        if (name === '' || name === null) {
          error = true;
          Cms.showError('Backup name is required!');
        }
        if (description === '' || description === null) {
          error = true;
          Cms.showError('Backup description is required!');
        }
        if (!error) {
          $.ajax({
            url: $('div[data-route-create]').data('route-create'),
            type: 'POST',
            data: {
              name: name,
              description: description
            },
            success: function success(data) {
              _self.removeClass('button-loading');
              _self.closest('.modal').modal('hide');
              if (data.error) {
                Cms.showError(data.message);
              } else {
                table_backup.find('.no-backup-row').remove();
                table_backup.find('tbody').append(data.data);
                Cms.showSuccess(data.message);
              }
            },
            error: function error(data) {
              _self.removeClass('button-loading');
              Cms.handleError(data);
            }
          });
        } else {
          _self.removeClass('button-loading');
        }
      });
    }
  }]);
}();
$(document).ready(function () {
  new BackupManagement().init();
});
/******/ })()
;