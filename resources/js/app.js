import './bootstrap';
import './home'; 

import Alpine from 'alpinejs';
import Swiper from 'swiper/bundle';
import catalogFilter from './catalog';
import appointmentScheduler from './appointmentScheduler';

window.Alpine = Alpine;

Alpine.data('catalogFilter', catalogFilter);
Alpine.data('appointmentScheduler', appointmentScheduler);

document.addEventListener('alpine:init', () => {
    Alpine.store('wishlist', {
        items: [], // Stores an array of saved Car IDs
        
        // Dynamic counter
        count() { 
            return this.items.length; 
        },
        
        // Fetches data on page load
        async init() {
            // Check if user is logged in by looking for a meta tag or checking a global variable
            // For now, we will safely try to fetch
            try {
                const response = await fetch('/wishlist/data', {
                    headers: { 'Accept': 'application/json' }
                });
                if(response.ok) {
                    const data = await response.json();
                    this.items = data.items;
                }
            } catch (error) {
                console.error("Wishlist sync failed", error);
            }
        },

        // Triggered when a user clicks the Star icon
        async toggle(carId) {
            // Optimistic UI update (feels instant)
            if (this.items.includes(carId)) {
                this.items = this.items.filter(id => id !== carId);
            } else {
                this.items.push(carId);
            }

            // Sync with Laravel 12 backend
            try {
                const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                
                const response = await fetch(`/wishlist/${carId}/toggle`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': csrfToken
                    }
                });
                
                const data = await response.json();
                this.items = data.items; // Ensure sync with true server state
            } catch (error) {
                console.error("Toggle failed", error);
            }
        }
    });
});

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