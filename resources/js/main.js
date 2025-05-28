import Swiper from 'swiper';
import { Autoplay } from 'swiper/modules';
import 'swiper/css';

import lightGallery from 'lightgallery';
import lgVideo from 'lightgallery/plugins/video'
import 'lightgallery/css/lightgallery-bundle.css';

const swiper = new Swiper('.swiper', {
    modules: [
        Autoplay
    ],
    loop: true,
    slidesPerView: "auto",
    spaceBetween: 30,
    // autoplay: {
    //     delay: 5000,
    // },
    // breakpoints: {
    //     500: {
    //         slidesPerView: 1,
    //         spaceBetween: 0
    //     },
    //     1020: {
    //         slidesPerView: 2,
    //         spaceBetween: 0
    //     },
    //     1040: {
    //         slidesPerView: 3,
    //         spaceBetween: 30
    //     },
    //     1570: {
    //         slidesPerView: 4,
    //         spaceBetween: 30
    //     },
    //     2100: {
    //         slidesPerView: 5,
    //         spaceBetween: 30
    //     }
    // },
    // autoHeight: true
});

lightGallery(document.querySelector('.lightgalery-container'), {
    plugins: [lgVideo],
    selector: '.lightgalery a'
});

(function () {
    function menuHandler() {
        const MainMenuContainer = document.getElementById('main-menu')
        const MainMenu = MainMenuContainer.querySelector('ul')
        const MainMenuBurger = MainMenuContainer.querySelector('#menu-burger')
        console.log(window.innerWidth)
        if (window.innerWidth <= 720) {
            MainMenu.style.display = 'none'
            MainMenuBurger.style.display = 'block'
        } else {
            MainMenu.style.display = 'grid'
            MainMenuBurger.style.display = 'none'
        }
    }
    document.addEventListener('DOMContentLoaded', menuHandler)
    window.onresize = function () {
        let timeout = setTimeout(function () {
            clearTimeout(timeout)
            menuHandler()
        }, 100)
    }
})()
