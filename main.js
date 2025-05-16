import Swiper from 'swiper';
import { Autoplay } from 'swiper/modules';
import 'swiper/css';

import lightGallery from 'lightgallery';
import lgVideo from 'lightgallery/plugins/video'

const swiper = new Swiper('.swiper', {
  modules: [
    Autoplay
  ],
  loop: true,
  slidesPerView: "auto",
  spaceBetween: 30,
  autoplay: {
    delay: 1000,
  },
  // autoHeight: true
});

lightGallery(document.querySelector('.lightgalery-container'), {
  plugins: [lgVideo],
  selector: '.lightgalery a'
});