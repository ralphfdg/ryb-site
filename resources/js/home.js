document.addEventListener('alpine:init', () => {
    
    // Existing Home Controller
    Alpine.data('homeController', () => ({
        heroTitle: 'Elevate Your Drive.',
        init() {
            console.log('RYB Home Controller Initialized');
        }
    }));

    // New Stats Counter Controller for Milestones
    Alpine.data('statsCounter', () => ({
        vehiclesDelivered: 0,
        partneredBrands: 0,
        happyClients: 0,
        yearsExperience: 0,

        // Target numbers based on your milestones
        targets: {
            vehiclesDelivered: 500,
            partneredBrands: 15,
            happyClients: 99,
            yearsExperience: 5
        },

        init() {
            // Function to animate a specific variable up to its target
            const animateValue = (property, target, duration) => {
                let startTimestamp = null;
                const step = (timestamp) => {
                    if (!startTimestamp) startTimestamp = timestamp;
                    const progress = Math.min((timestamp - startTimestamp) / duration, 1);
                    this[property] = Math.floor(progress * target);
                    if (progress < 1) {
                        window.requestAnimationFrame(step);
                    }
                };
                window.requestAnimationFrame(step);
            };

            // Trigger the animations over 2 seconds (2000ms)
            animateValue('vehiclesDelivered', this.targets.vehiclesDelivered, 2000);
            animateValue('partneredBrands', this.targets.partneredBrands, 2000);
            animateValue('happyClients', this.targets.happyClients, 2000);
            animateValue('yearsExperience', this.targets.yearsExperience, 2000);
        }
    }));

});