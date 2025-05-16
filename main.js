import Swiper from 'swiper';
import 'swiper/css';

import lightGallery from 'lightgallery';
import lgThumbnail from 'lightgallery/plugins/thumbnail'
import lgZoom from 'lightgallery/plugins/zoom'
import lgVideo from 'lightgallery/plugins/video'

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
  // autoHeight: true
});

lightGallery(document.querySelector('.lightgalery-container'), {
  plugins: [lgVideo],
  selector: '.lightgalery a'
});