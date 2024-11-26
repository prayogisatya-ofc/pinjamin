/**
 * Main - Front Pages
 */
'use strict';

(function () {
  const swiperReviews = document.getElementById('swiper-reviews')

  // swiper carousel
  // Customers reviews
  // -----------------------------------
  if (swiperReviews) {
    new Swiper(swiperReviews, {
      slidesPerView: 1,
      spaceBetween: 0,
      grabCursor: true,
      autoplay: {
        delay: 3000,
        disableOnInteraction: false
      },
      loop: true,
      loopAdditionalSlides: 1,
      navigation: {
        nextEl: '#reviews-next-btn',
        prevEl: '#reviews-previous-btn'
      },
      breakpoints: {
        1200: {
          slidesPerView: 5
        },
        375: {
          slidesPerView: 2
        }
      }
    });
  }
})();
