/******/ (() => { // webpackBootstrap
/*!********************************************************!*\
  !*** ./platform/core/acl/resources/assets/js/login.js ***!
  \********************************************************/
function _typeof(o) { "@babel/helpers - typeof"; return _typeof = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function (o) { return typeof o; } : function (o) { return o && "function" == typeof Symbol && o.constructor === Symbol && o !== Symbol.prototype ? "symbol" : typeof o; }, _typeof(o); }
function _classCallCheck(a, n) { if (!(a instanceof n)) throw new TypeError("Cannot call a class as a function"); }
function _defineProperties(e, r) { for (var t = 0; t < r.length; t++) { var o = r[t]; o.enumerable = o.enumerable || !1, o.configurable = !0, "value" in o && (o.writable = !0), Object.defineProperty(e, _toPropertyKey(o.key), o); } }
function _createClass(e, r, t) { return r && _defineProperties(e.prototype, r), t && _defineProperties(e, t), Object.defineProperty(e, "prototype", { writable: !1 }), e; }
function _toPropertyKey(t) { var i = _toPrimitive(t, "string"); return "symbol" == _typeof(i) ? i : i + ""; }
function _toPrimitive(t, e) { if ("object" != _typeof(t) || !t) return t; var r; if ("undefined" != typeof Symbol && void 0 !== (r = t[Symbol.toPrimitive])) { var i = r.call(t, e || "default"); if ("object" != _typeof(i)) return i; throw new TypeError("@@toPrimitive must return a primitive value."); } return ("string" === e ? String : Number)(t); }
var Login = /*#__PURE__*/function () {
  function Login() {
    _classCallCheck(this, Login);
  }
  return _createClass(Login, [{
    key: "handleLogin",
    value: function handleLogin() {
      $('.login-form').validate({
        errorElement: 'span',
        //default input error message container
        errorClass: 'help-block',
        // default input error message class
        focusInvalid: false,
        // do not focus the last invalid input
        rules: {
          username: {
            required: true
          },
          password: {
            required: true
          },
          remember: {
            required: false
          }
        },
        messages: {
          username: {
            required: 'Username is required.'
          },
          password: {
            required: 'Password is required.'
          }
        },
        invalidHandler: function invalidHandler() {
          //display error alert on form submit
          $('.alert-danger', $('.login-form')).show();
        },
        highlight: function highlight(element) {
          // highlight error inputs
          $(element).closest('.form-group').addClass('has-error'); // set error class to the control group
        },
        success: function success(label) {
          label.closest('.form-group').removeClass('has-error');
          label.remove();
        },
        errorPlacement: function errorPlacement(error, element) {
          error.insertAfter(element.closest('.form-control'));
        },
        submitHandler: function submitHandler(form) {
          form.submit(); // form validation success, call ajax form submit
        }
      });
      $('.login-form input').keypress(function (e) {
        if (e.which === 13) {
          var $form = $('.login-form');
          if ($form.validate().form()) {
            $form.submit(); //form validation success, call ajax form submit
          }
          return false;
        }
      });
    }
  }, {
    key: "handleForgetPassword",
    value: function handleForgetPassword() {
      $('.forget-form').validate({
        errorElement: 'span',
        //default input error message container
        errorClass: 'help-block',
        // default input error message class
        focusInvalid: false,
        // do not focus the last invalid input
        ignore: '',
        rules: {
          email: {
            required: true,
            email: true
          }
        },
        messages: {
          email: {
            required: 'Email is required.'
          }
        },
        invalidHandler: function invalidHandler() {
          //display error alert on form submit
          $('.alert-danger', $('.forget-form')).show();
        },
        highlight: function highlight(element) {
          // hightlight error inputs
          $(element).closest('.form-group').addClass('has-error'); // set error class to the control group
        },
        success: function success(label) {
          label.closest('.form-group').removeClass('has-error');
          label.remove();
        },
        errorPlacement: function errorPlacement(error, element) {
          error.insertAfter(element.closest('.form-control'));
        },
        submitHandler: function submitHandler(form) {
          form.submit();
        }
      });
      $('.forget-form input').keypress(function (e) {
        if (e.which === 13) {
          if ($('.forget-form').validate().form()) {
            $('.forget-form').submit();
          }
          return false;
        }
      });
    }
  }, {
    key: "init",
    value: function init() {
      this.handleLogin();
      this.handleForgetPassword();
    }
  }]);
}();
$(document).ready(function () {
  new Login().init();
  var username = document.querySelector('[name="username"]');
  var email = document.querySelector('[name="email"]');
  var password = document.querySelector('[name="password"]');
  var passwordConfirmation = document.querySelector('[name="password_confirmation"]');
  if (username) {
    username.focus();
    document.getElementById('emailGroup').classList.add('focused');

    // Focus events for email and password fields
    username.addEventListener('focusin', function () {
      document.getElementById('emailGroup').classList.add('focused');
    });
    username.addEventListener('focusout', function () {
      document.getElementById('emailGroup').classList.remove('focused');
    });
  }
  if (email) {
    email.focus();
    document.getElementById('emailGroup').classList.add('focused');

    // Focus events for email and password fields
    email.addEventListener('focusin', function () {
      document.getElementById('emailGroup').classList.add('focused');
    });
    email.addEventListener('focusout', function () {
      document.getElementById('emailGroup').classList.remove('focused');
    });
  }
  if (password) {
    password.addEventListener('focusin', function () {
      document.getElementById('passwordGroup').classList.add('focused');
    });
    password.addEventListener('focusout', function () {
      document.getElementById('passwordGroup').classList.remove('focused');
    });
  }
  if (passwordConfirmation) {
    passwordConfirmation.addEventListener('focusin', function () {
      document.getElementById('passwordConfirmationGroup').classList.add('focused');
    });
    passwordConfirmation.addEventListener('focusout', function () {
      document.getElementById('passwordConfirmationGroup').classList.remove('focused');
    });
  }
});
/******/ })()
;