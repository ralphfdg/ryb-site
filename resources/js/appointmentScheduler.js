export default (bookedSlots = []) => ({
    activeTab: 'appointment',
    selectedDate: '',
    selectedTime: '',
    availableDates: [],
    
    // Data passed from Blade is caught in the parameter above
    bookedSlots: bookedSlots, 
    
    timeSlots: [
        { value: '09:00', display: '09:00 AM' },
        { value: '11:00', display: '11:00 AM' },
        { value: '13:00', display: '01:00 PM' },
        { value: '15:00', display: '03:00 PM' },
        { value: '16:30', display: '04:30 PM' }
    ],

    init() {
        this.generateDates();
        
        // Reset time selection if the date changes
        this.$watch('selectedDate', () => {
            this.selectedTime = '';
        });
    },

    generateDates() {
        for(let i = 1; i <= 6; i++) {
            let d = new Date();
            d.setDate(d.getDate() + i);
            
            // Skip Sundays (0 = Sunday in JS Date)
            if(d.getDay() === 0) {
                i++; 
                d.setDate(d.getDate() + 1);
            }

            // Format value for Laravel (YYYY-MM-DD)
            let val = d.toISOString().split('T')[0];
            
            this.availableDates.push({
                value: val,
                dayName: d.toLocaleDateString('en-US', { weekday: 'short' }),
                display: d.toLocaleDateString('en-US', { month: 'short', day: 'numeric' })
            });
        }
    },

    get processedTimeSlots() {
        if(!this.selectedDate) return [];

        return this.timeSlots.map(time => {
            let slotDateTime = `${this.selectedDate} ${time.value}`;
            return { 
                ...time, 
                isBooked: this.bookedSlots.includes(slotDateTime)
            };
        });
    },

    get formattedDateTime() {
        if(!this.selectedDate || !this.selectedTime) return '';
        return `${this.selectedDate} ${this.selectedTime}:00`;
    },

    validateForm(e) {
        if(!this.selectedDate || !this.selectedTime) {
            e.preventDefault();
            alert('Please select both an available date and time to continue.');
        }
    }
});