export default (bookedSlots = []) => ({
    activeTab: 'appointment',
    selectedDate: '',
    selectedTime: '',
    availableDates: [],
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
        this.$watch('selectedDate', () => {
            this.selectedTime = '';
        });
    },

    generateDates() {
        this.availableDates = []; // Clear array to prevent duplicates

        for (let i = 1; i <= 6; i++) {
            let d = new Date();
            d.setDate(d.getDate() + i);
            
            // Skip Sundays
            if (d.getDay() === 0) {
                i++;
                d.setDate(d.getDate() + 1);
            }

            // Extract strictly local time values to avoid UTC backward shifts
            let year = d.getFullYear();
            let month = String(d.getMonth() + 1).padStart(2, '0');
            let day = String(d.getDate()).padStart(2, '0');
            let localDateValue = `${year}-${month}-${day}`;

            this.availableDates.push({
                value: localDateValue, 
                dayName: d.toLocaleDateString('en-US', { weekday: 'short' }),
                display: d.toLocaleDateString('en-US', { month: 'short', day: 'numeric' })
            });
        }
    },

    get processedTimeSlots() {
        if (!this.selectedDate) return [];
        return this.timeSlots.map(time => ({
            ...time,
            isBooked: this.bookedSlots.includes(`${this.selectedDate} ${time.value}`)
        }));
    },

    get formattedDateTime() {
        return (this.selectedDate && this.selectedTime) 
            ? `${this.selectedDate} ${this.selectedTime}:00` 
            : '';
    },

    validateForm(e, isAdmin = false) {
        // 1. If Admin didn't touch the scheduler (both empty), allow the submit
        if (isAdmin && !this.selectedDate && !this.selectedTime) {
            return true; 
        }

        // 2. If they ARE in the catalog (isAdmin = false) OR if they started picking a date:
        // They MUST select both Date and Time.
        if (!this.selectedDate || !this.selectedTime) {
            e.preventDefault();
            alert('Please select both a date and a time slot.');
            return false;
        }

        return true;
    }
});