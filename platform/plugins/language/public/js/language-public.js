/**
 * Dual Translation System (Google Translate + CMS Manual Translations)
 * Frontend Manager
 */
class LanguagePublicManagement {
    constructor() {
        this.config = null;
        this.defaultLang = 'en';
        this.includedLangs = 'en,hi,kn';
        this.translationMode = 'both';
        this.showDisclaimer = true;
    }

    init() {
        this.readConfig();
        this.initDropdown();
        this.initGoogleTranslate();
        this.checkActiveTranslation();
        this.exposeGlobalFunctions();
    }

    readConfig() {
        const configEl = document.getElementById('gt-config');
        if (configEl) {
            this.translationMode = configEl.getAttribute('data-mode') || 'both';
            this.defaultLang = configEl.getAttribute('data-default-lang') || 'en';
            this.includedLangs = configEl.getAttribute('data-included-langs') || 'en,hi,kn';
            this.showDisclaimer = configEl.getAttribute('data-show-disclaimer') === '1';
        }
    }

    initDropdown() {
        // Toggle dropdown on button click
        $(document).on('click', '.language-wrapper .language-toggle-btn', function (event) {
            event.preventDefault();
            event.stopPropagation();
            const $wrap = $(this).closest('.language-switcher-wrap');
            const $menu = $wrap.find('.language_bar_chooser');
            const isOpen = $wrap.hasClass('show') || $menu.is(':visible');

            // Close all dropdowns
            $('.language-switcher-wrap').removeClass('show open');
            $('.language-switcher-wrap .language_bar_chooser').hide();
            $('.language-switcher-wrap .language-toggle-btn').removeClass('active').attr('aria-expanded', 'false');

            if (!isOpen) {
                $wrap.addClass('show open');
                $menu.show();
                $(this).addClass('active').attr('aria-expanded', 'true');
            }
        });

        // Close dropdown when clicking anywhere outside
        $(document).on('click', function (event) {
            if (!$(event.target).closest('.language-switcher-wrap').length) {
                $('.language-switcher-wrap').removeClass('show open');
                $('.language-switcher-wrap .language_bar_chooser').hide();
                $('.language-switcher-wrap .language-toggle-btn').removeClass('active').attr('aria-expanded', 'false');
            }
        });

        // Close dropdown when pressing Escape key
        $(document).on('keydown', function (event) {
            if (event.key === 'Escape' || event.keyCode === 27) {
                $('.language-switcher-wrap').removeClass('show open');
                $('.language-switcher-wrap .language_bar_chooser').hide();
                $('.language-switcher-wrap .language-toggle-btn').removeClass('active').attr('aria-expanded', 'false');
            }
        });
    }

    initGoogleTranslate() {
        if (this.translationMode !== 'google' && this.translationMode !== 'both') {
            return;
        }

        // Only inject Google Translate script if there is an active translation cookie
        // or if explicitly invoked by user action. This prevents Google Translate from
        // shifting the layout or pushing .top-bar on normal page views.
        const activeCookie = this.getCookie('googtrans');
        if (activeCookie && !activeCookie.endsWith('/' + this.defaultLang)) {
            this.loadGoogleTranslateScript();
        }
    }

    loadGoogleTranslateScript(callback) {
        if (window.__gtScriptInjected) {
            if (typeof callback === 'function') {
                callback();
            }
            return;
        }
        window.__gtScriptInjected = true;

        const defaultLang = this.defaultLang;
        const includedLangs = this.includedLangs;

        window.googleTranslateElementInit = function () {
            if (window.__gtInitialized) return;
            window.__gtInitialized = true;

            try {
                new google.translate.TranslateElement({
                    pageLanguage: defaultLang,
                    includedLanguages: includedLangs,
                    autoDisplay: false,
                    multilanguagePage: true
                }, 'google_translate_element');

                if (typeof callback === 'function') {
                    callback();
                }
            } catch (err) {
                console.warn('[Language] Google Translate initialization error:', err);
            }
        };

        // Prevent Google Translate from adding inline top: 40px to body
        this.lockBodyTop();

        // Check if script is already present
        if (!document.getElementById('google-translate-script')) {
            const script = document.createElement('script');
            script.id = 'google-translate-script';
            script.type = 'text/javascript';
            script.src = '//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit';
            script.async = true;
            script.defer = true;
            script.onerror = function () {
                console.warn('[Language] Google Translate script could not be loaded.');
            };
            document.body.appendChild(script);
        }
    }

    lockBodyTop() {
        if (window.__gtBodyObserverSet) return;
        window.__gtBodyObserverSet = true;

        const reset = () => {
            [document.body, document.documentElement].forEach(el => {
                if (el && el.style.top && el.style.top !== '0px') el.style.top = '0px';
            });
        };
        reset();

        if (window.MutationObserver) {
            const observer = new MutationObserver(reset);
            observer.observe(document.body, { attributes: true, attributeFilter: ['style'] });
            observer.observe(document.documentElement, { attributes: true, attributeFilter: ['style'] });
        }
    }

    checkActiveTranslation() {
        const cookie = this.getCookie('googtrans');
        if (cookie) {
            const parts = cookie.split('/');
            const targetLang = parts[parts.length - 1];
            if (targetLang && targetLang !== this.defaultLang) {
                this.displayDisclaimerBar();
                this.updateCurrentLanguageDisplay(targetLang);
                return;
            }
        }
        // Fallback or default language
        this.updateCurrentLanguageDisplay(null);
    }

    updateCurrentLanguageDisplay(gtLangCode) {
        const $name = $('.current-lang-name');
        const $flag = $('.current-lang-flag');

        if (!gtLangCode || gtLangCode === this.defaultLang) {
            // Restore default view
            if ($name.length && $name.attr('data-default-name')) {
                $name.text($name.attr('data-default-name'));
            }
            if ($flag.length && $flag.attr('data-default-flag')) {
                $flag.html($flag.attr('data-default-flag'));
            }
            $('.language_bar_chooser li').removeClass('active');
            $('.language_bar_chooser li[data-locale="' + this.defaultLang + '"]').addClass('active');
            return;
        }

        // Find the language in the dropdown list with this language code or locale
        let $li = $('.language_bar_chooser li[data-gt-code="' + gtLangCode + '"]');
        if (!$li.length) {
            $li = $('.language_bar_chooser li[data-locale="' + gtLangCode + '"]');
        }
        let $link = $li.length ? $li.find('a').first() : $('.language_bar_chooser a[data-lang-code="' + gtLangCode + '"]');
        if (!$link.length) {
            $link = $('.language_bar_chooser a[data-google-code="' + gtLangCode + '"]');
        }

        if ($link.length) {
            const langName = $link.attr('data-lang-name') || $link.find('.lang-text').text() || $link.text();
            const $flagImg = $link.find('img').first();

            if (langName && $name.length) {
                $name.text(langName.trim());
            }
            if ($flagImg.length && $flag.length) {
                $flag.html($flagImg.prop('outerHTML'));
            }

            // Mark this item as active in dropdown
            $('.language_bar_chooser li').removeClass('active');
            $link.closest('li').addClass('active');
        }
    }

    displayDisclaimerBar() {
        // Disclaimer bar disabled so top bar is never hidden or pushed
    }

    hideDisclaimerBar() {
        // Disclaimer bar disabled
    }

    getCookie(name) {
        const match = document.cookie.match(new RegExp('(^|;\\s*)(' + name + ')=([^;]*)'));
        return match ? decodeURIComponent(match[3]) : null;
    }

    setCookie(name, value, days) {
        let expires = '';
        if (days) {
            const date = new Date();
            date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
            expires = '; expires=' + date.toUTCString();
        }
        const hostname = window.location.hostname;
        document.cookie = name + '=' + encodeURIComponent(value) + expires + '; path=/;';
        if (hostname.indexOf('.') !== -1) {
            document.cookie = name + '=' + encodeURIComponent(value) + expires + '; path=/; domain=' + hostname + ';';
        }
    }

    deleteCookie(name) {
        const hostname = window.location.hostname;
        const expired = '; expires=Thu, 01 Jan 1970 00:00:01 GMT; path=/;';
        document.cookie = name + '=' + expired;
        document.cookie = name + '=' + expired + ' domain=' + hostname + ';';
        document.cookie = name + '=' + expired + ' domain=.' + hostname + ';';
    }

    exposeGlobalFunctions() {
        const self = this;

        window.triggerGoogleTranslate = function (targetCode) {
            if (!targetCode || targetCode === self.defaultLang) {
                window.resetGoogleTranslate();
                return;
            }

            self.setCookie('googtrans', '/auto/' + targetCode);

            // Immediately update the dropdown button label, flag, and active state
            self.updateCurrentLanguageDisplay(targetCode);

            // Close the dropdown menu
            $('.language-switcher-wrap').removeClass('show open');
            $('.language-switcher-wrap .language_bar_chooser').hide();
            $('.language-wrapper .language-toggle-btn').removeClass('active').attr('aria-expanded', 'false');

            const select = document.querySelector('#google_translate_element select.goog-te-combo');
            if (select) {
                select.value = targetCode;
                select.dispatchEvent(new Event('change'));
                self.displayDisclaimerBar();
            } else {
                // If script hasn't loaded, load it now and reload/initialize
                self.loadGoogleTranslateScript(() => {
                    const readySelect = document.querySelector('#google_translate_element select.goog-te-combo');
                    if (readySelect) {
                        readySelect.value = targetCode;
                        readySelect.dispatchEvent(new Event('change'));
                        self.displayDisclaimerBar();
                    } else {
                        window.location.reload();
                    }
                });
                // Fallback reload if script takes time
                setTimeout(() => {
                    const fallbackSelect = document.querySelector('#google_translate_element select.goog-te-combo');
                    if (!fallbackSelect) {
                        window.location.reload();
                    }
                }, 1000);
            }
        };

        window.resetGoogleTranslate = function () {
            self.deleteCookie('googtrans');
            self.hideDisclaimerBar();

            const select = document.querySelector('#google_translate_element select.goog-te-combo');
            if (select && select.value !== self.defaultLang) {
                select.value = self.defaultLang;
                select.dispatchEvent(new Event('change'));
            }

            window.location.reload();
        };

        window.clearGoogleTranslateCookie = function () {
            self.deleteCookie('googtrans');
            self.hideDisclaimerBar();
        };

        window.dismissGoogleDisclaimer = function () {
            self.hideDisclaimerBar();
        };
    }
}

$(document).ready(() => {
    new LanguagePublicManagement().init();
});
