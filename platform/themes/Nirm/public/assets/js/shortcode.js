baguetteBox.run('.grid-gallery', {
    animation: 'slideIn'
});

// client carousel slider
const cardslider = new Swiper("#card-slider", {
    spaceBetween: 10,
    pagination: false,
    autoplay: true,
    autoplayTimeout: 5000,
    breakpoints: {
        0: {
            slidesPerView: 1,
            spaceBetween: 15
        },
        768: {
            slidesPerView: 2,
            spaceBetween: 10
        },
        1024: {
            slidesPerView: 3,
            spaceBetween: 10
        },
        1399: {
            slidesPerView: 4,
            spaceBetween: 10
        }
    },
});

// client carousel slider
const imageSlider = new Swiper("#image-slider", {
    spaceBetween: 10,
    autoplay: false,
    navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
      },
    breakpoints: {
        0: {
            slidesPerView: 1,
            spaceBetween: 15
        },
        768: {
            slidesPerView: 2,
            spaceBetween: 10
        },
        1024: {
            slidesPerView: 3,
            spaceBetween: 10
        },
        1399: {
            slidesPerView: 4,
            spaceBetween: 10
        }
    },
});