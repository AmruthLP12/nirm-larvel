if (typeof jQuery === "undefined") {
    throw new Error("jQuery required");
}

+(function ($) {
    "use strict";

    // SEARCHBAR CLASS DEFINITION
    // =========================

    var backdrop = ".searchbar-backdrop";
    var toggle = '[data-toggle="searchbar"]';
    var Searchbar = function (element) {
        $(element).on("click.mr.searchbar", this.toggle);
    };

    Searchbar.VERSION = "1.0.0";

    Searchbar.prototype.toggle = function (e) {
        var $this = $(this);

        if ($this.is(".disabled, :disabled")) return;

        var $parent = getParent($this);
        var isActive =
            $parent.hasClass("open") || (typeof isXS == "function" && isXS());

        if (!isActive) {
            clearMenus();
            if (
                "ontouchstart" in document.documentElement &&
                !$parent.closest(".navbar-nav").length
            ) {
                // if mobile we use a backdrop because click events don't delegate
                $('<div class="searchbar-backdrop"/>')
                    .insertAfter($(this))
                    .on("click", clearMenus);
            }

            var relatedTarget = { relatedTarget: this };
            $parent.trigger((e = $.Event("show.mr.searchbar", relatedTarget)));

            if (e.isDefaultPrevented()) return;
            e.preventDefault();

            $parent.find("input").trigger("focus");

            $parent
                .toggleClass("open")
                .trigger("shown.mr.searchbar", relatedTarget);

            return false;
        }
    };

    function clearMenus(e) {
        if (e && e.which === 3) return;
        $(backdrop).remove();
        $(toggle).each(function () {
            var $parent = getParent($(this));
            var relatedTarget = { relatedTarget: this };
            if (!$parent.hasClass("open")) return;
            $parent.trigger((e = $.Event("hide.mr.searchbar", relatedTarget)));
            if (e.isDefaultPrevented()) return;
            $parent
                .removeClass("open")
                .trigger("hidden.mr.searchbar", relatedTarget);
        });
    }

    function getParent($this) {
        var selector = $this.attr("data-target");

        if (!selector) {
            return $this.parents("form");
        }

        var $parent = selector && $(selector);

        return $parent && $parent.length ? $parent : $this.parent();
    }

    // SEARCHBAR PLUGIN DEFINITION
    // ==========================

    // function Plugin(option) {
    //   return this.each(function () {
    //     var $this = $(this);
    //     var data  = $this.data('mr.searchbar');

    //     if (!data) $this.data('mr.searchbar', (data = new Searchbar(this)));
    //     if (typeof option == 'string') data[option].call($this);
    //   });
    // }

    var old = $.fn.searchbar;

    $.fn.searchbar = Plugin;
    $.fn.searchbar.Constructor = Searchbar;

    // SEARCHBAR NO CONFLICT
    // ====================

    // $.fn.searchbar.noConflict = function () {
    //   $.fn.searchbar = old;
    //   return this;
    // };

    // APPLY TO STANDARD SEARCHBAR ELEMENTS
    // ===================================

    $(document)
        .on("click.mr.searchbar.data-api", clearMenus)
        .on("click.mr.searchbar.data-api", ".searchbar", function (e) {
            e.stopPropagation();
        })
        //.on('focus.mr.searchbar.data-api', toggle, Searchbar.prototype.toggle) // this causes the focus event to trigger twice
        .on("click.mr.searchbar.data-api", toggle, Searchbar.prototype.toggle);
})(jQuery);

// main-slider
const mainSlider = new Swiper("#main-slider", {
    slidesPerView: 1,
    pagination: true,
    loop: false,
    pagination: {
        el: ".swiper-pagination",
        clickable: true,
    },
});

// client carousel slider
const clientSlider = new Swiper("#client-slider", {
    spaceBetween: 30,
    pagination: false,
    autoplay: true,
    autoplayTimeout: 5000,
    breakpoints: {
        0: {
            slidesPerView: 1,
            spaceBetween: 15,
        },
        576: {
            slidesPerView: 2,
            spaceBetween: 30,
        },
        768: {
            slidesPerView: 2,
            spaceBetween: 30,
        },
        1024: {
            slidesPerView: 3,
            spaceBetween: 30,
        },
        1199: {
            slidesPerView: 3,
            spaceBetween: 30,
        },
        1399: {
            slidesPerView: 6,
            spaceBetween: 30,
        },
    },
});

// image-conttent slider
var swiper = new Swiper(".gallery", {
    spaceBetween: 10,
    slidesPerView: 3,
    freeMode: true,
    navigation: false,
    watchSlidesProgress: true,
});
var swiper2 = new Swiper(".gallery2", {
    spaceBetween: 10,
    speed: 2000,
    effect: "fade",
    navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
    },
    thumbs: {
        swiper: swiper,
    },
});

var galleryThumbs = new Swiper(".gallery-thumbs", {
    centeredSlides: true,
    centeredSlidesBounds: true,
    slidesPerView: 3,
    spaceBetween: 20,
    watchOverflow: true,
    watchSlidesVisibility: true,
    watchSlidesProgress: true,
    direction: "horizontal",
    breakpoints: {
        767: {
            slidesPerView: 3,
            direction: "vertical",
        },
    },
});

var galleryMain = new Swiper(".gallery-main", {
    watchOverflow: true,
    watchSlidesVisibility: true,
    watchSlidesProgress: true,
    preventInteractionOnTransition: true,
    navigation: false,
    pagination: false,
    effect: "fade",
    fadeEffect: {
        crossFade: true,
    },
    thumbs: {
        swiper: galleryThumbs,
    },
});

galleryMain.on("slideChangeTransitionStart", function () {
    galleryThumbs.slideTo(galleryMain.activeIndex);
});

galleryThumbs.on("transitionStart", function () {
    galleryMain.slideTo(galleryThumbs.activeIndex);
});

// Font size

var fontSize = 14;
jQuery(document).ready(function () {
    // alert("ok");
    if (_getCookie("fontSize") != null) {
        var fontSize = _getCookie("fontSize");
    } else {
        var fontSize = 14;
    }
    jQuery("#fontSize").css("font-size", fontSize + "px");
});
function _getCookie(name) {
    var arg = name + "=";
    var alen = arg.length;
    var clen = document.cookie.length;
    var i = 0;
    while (i < clen) {
        var j = i + alen;
        if (document.cookie.substring(i, j) == arg) {
            return _getCookieVal(j);
        }
        i = document.cookie.indexOf(" ", i) + 1;
        if (i == 0) break;
    }
    return null;
}
function _deleteCookie(name, path, domain) {
    if (_getCookie(name)) {
        document.cookie =
            name +
            "=" +
            (path ? "; path=" + path : "") +
            (domain ? "; domain=" + domain : "") +
            "; expires=Thu, 01-Jan-70 00:00:01 GMT";
    }
}
function _setCookie(name, value, expires, path, domain, secure) {
    var vurl = true;
    if (path != "" && path != undefined) {
        vurl = validUrl(path);
    }
    if (jQuery.type(name) == "string" && vurl) {
        document.cookie =
            name +
            "=" +
            escape(value) +
            (expires ? "; expires=" + expires.toGMTString() : "") +
            (path ? "; path=" + path : "") +
            (domain ? "; domain=" + domain : "") +
            (secure ? "; secure" : "");
    }
}
function _getCookieVal(offset) {
    var endstr = document.cookie.indexOf(";", offset);
    if (endstr == -1) {
        endstr = document.cookie.length;
    }
    return unescape(document.cookie.substring(offset, endstr));
}
/*********Font size resize**********/
function set_font_size(fontType) {
    if (fontType == "increase") {
        if (fontSize < 16) {
            fontSize = parseInt(fontSize) + 1;
        }
    } else if (fontType == "decrease") {
        if (fontSize > 12) {
            fontSize = parseInt(fontSize) - 1;
        }
    } else {
        fontSize = 14;
    }
    _setCookie("fontSize", fontSize);
    jQuery("#fontSize").css("font-size", fontSize + "px");
    //jQuery("#template_three_column").css("font-size",fontSize + "%");
}

// Theme switch

//elements
const inputCheckbox = window.document.querySelector(".switcher-input");
const documentBody = document.body;

//events
if (inputCheckbox) {
    inputCheckbox.addEventListener("change", () => {
        let theme = getTheme();

        if (theme == "dark") {
            setTheme("light");
        } else {
            setTheme("dark");
        }
    });
}

//functions
function changeBackground() {
    let theme = getTheme();

    if (theme == "dark") {
        documentBody.classList.add("darkTheme");
    } else {
        documentBody.classList.remove("darkTheme");
    }
}

function checkTheme() {
    let theme = getTheme();
    if (theme == null || theme == undefined || typeof theme != "string") {
        setTheme("light");
    } else {
        if (theme == "dark") {
            setTheme("dark");
        } else {
            setTheme("light");
        }
    }
}

function setTheme(theme = "light") {
    window.localStorage.setItem("theme", theme);
    changeBackground();
}

function getTheme() {
    return window.localStorage.getItem("theme");
}

checkTheme();
