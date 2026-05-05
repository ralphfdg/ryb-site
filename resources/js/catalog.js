export default function catalogFilter() {
    return {
        isSearching: false,
        compareList: [], // Tracks selected car IDs
        maxCompare: 3,

        toggleCompare(carId) {
            const index = this.compareList.indexOf(carId);
            if (index > -1) {
                // Remove if already selected
                this.compareList.splice(index, 1);
            } else {
                // Add if under limit
                if (this.compareList.length < this.maxCompare) {
                    this.compareList.push(carId);
                } else {
                    alert('You can only compare up to 3 vehicles at a time.');
                }
            }
        },

        goToCompare() {
            if (this.compareList.length < 2) return;
            
            // Build the query string manually for the array (e.g., ?cars[]=1&cars[]=2)
            const params = new URLSearchParams();
            this.compareList.forEach(id => params.append('cars[]', id));
            
            window.location.href = `/catalog/compare?${params.toString()}`;
        },
        
        submitForm() {
            this.isSearching = true;
            
            const form = this.$refs.filterForm;
            const url = new URL(form.action);
            const formData = new FormData(form);
            
            const searchParams = new URLSearchParams(formData);
            url.search = searchParams.toString();

            window.history.pushState({}, '', url);

            fetch(url, {
                headers: { 'X-Requested-With': 'XMLHttpRequest' }
            })
            .then(response => response.text())
            .then(html => {
                const parser = new DOMParser();
                const doc = parser.parseFromString(html, 'text/html');
                document.getElementById('catalog-main-content').innerHTML = doc.getElementById('catalog-main-content').innerHTML;
            })
            .finally(() => {
                this.isSearching = false;
            });
        }
    }
}