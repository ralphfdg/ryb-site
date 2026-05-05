import './bootstrap';
import './home'; 

import Alpine from 'alpinejs';
import Swiper from 'swiper/bundle';
import catalogFilter from './catalog';
import appointmentScheduler from './appointmentScheduler';

window.Alpine = Alpine;

Alpine.data('catalogFilter', catalogFilter);
Alpine.data('appointmentScheduler', appointmentScheduler);

Alpine.start();

// Initialize Swiper only if the gallery elements exist on the page
document.addEventListener('DOMContentLoaded', () => {
    if (document.querySelector('.mySwiper')) {
        const swiperThumbs = new Swiper(".mySwiper", {
            spaceBetween: 10,
            slidesPerView: 4,
            freeMode: true,
            watchSlidesProgress: true,
        });
        
        const swiperMain = new Swiper(".mySwiper2", {
            spaceBetween: 10,
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
            thumbs: {
                swiper: swiperThumbs,
            },
        });
    }
});