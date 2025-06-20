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
    autoplay: {
        delay: 2000,
    },
    speed: 2000
    // autoHeight: true
});

lightGallery(document.querySelector('.lightgalery-container'), {
    plugins: [lgVideo],
    selector: '.lightgalery a'
});

(function () {
    function menuHandler() {
        const MainMenuContainer = document.getElementById('main-menu')

        if (!MainMenuContainer) {
            return
        }

        const MainMenu = MainMenuContainer.querySelector('ul')
        const MainMenuBurger = MainMenuContainer.querySelector('#menu-burger')

        if (window.innerWidth <= 720) {
            MainMenuBurger.classList.remove('hidden')

            if (MainMenu.classList.contains('collspased')) {
                MainMenu.style.height = '0px'
            }

            if (!window?.mainMenu?.menuLoaded) {
                const MainMenuHeight = MainMenu.clientHeight
                MainMenu.style.height = '0px'
                MainMenu.classList.add('collspased')
                MainMenuBurger.onclick = function () {
                    MainMenu.classList.toggle('collspased')
                    if (MainMenu.classList.contains('collspased')) {
                        MainMenu.style.height = '0px'
                    } else {
                        MainMenu.style.height = MainMenuHeight + 'px'
                    }
                }

                window.mainMenu = {}
                window.mainMenu.menuLoaded = true
            }
        } else {
            MainMenuBurger.classList.add('hidden')
            MainMenu.style.height = 'auto'
        }
    }
    document.addEventListener('DOMContentLoaded', menuHandler)
    window.onresize = function () {
        let timeout = setTimeout(function () {
            clearTimeout(timeout)
            menuHandler()
        }, 100)
    }
})();

// import {createApp} from "vue";
// import UploadVideosComponent from "./components/admin/UploadVideosComponent.vue";
//
// (function () {
//     let el = document.getElementById('upload-videos-component');
//     if (el) {
//         let app = createApp(UploadVideosComponent).mount(el)
//     }
// })();
