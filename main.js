import Swiper from 'swiper';
import 'swiper/css';

const swiper = new Swiper('.swiper', {
  loop: true,
  pagination: {
    el: '.swiper-pagination',
  },
  slidesPerView: "auto",
  spaceBetween: 30,
  autoplay: {
    delay: 5000,
  },
  autoHeight: true
});