document.addEventListener('alpine:init', () => {
    Alpine.data('homeController', () => ({
        heroTitle: 'Excellence in Motion',
    }));

    Alpine.data('statsCounter', () => ({
        vehiclesDelivered: 0,
        partneredBrands: 0,
        happyClients: 0,
        yearsExperience: 0,

        init() {
            // Simple counter animation for the stats section
            this.animateValue('vehiclesDelivered', 0, 1250, 2000);
            this.animateValue('partneredBrands', 0, 15, 2000);
            this.animateValue('happyClients', 0, 99, 2000);
            this.animateValue('yearsExperience', 0, 10, 2000);
        },

        animateValue(property, start, end, duration) {
            let startTimestamp = null;
            const step = (timestamp) => {
                if (!startTimestamp) startTimestamp = timestamp;
                const progress = Math.min((timestamp - startTimestamp) / duration, 1);
                this[property] = Math.floor(progress * (end - start) + start);
                if (progress < 1) {
                    window.requestAnimationFrame(step);
                }
            };
            window.requestAnimationFrame(step);
        }
    }));
});