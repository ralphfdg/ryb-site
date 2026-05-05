// resources/js/catalog.js

export default function catalogFilter() {
    return {
        isSearching: false, // Optional: useful for loading spinners if you want them later
        
        submitForm() {
            this.isSearching = true;
            
            // 1. Get the form and its current data
            const form = this.$refs.filterForm;
            const url = new URL(form.action);
            const formData = new FormData(form);
            
            // 2. Build the query string (e.g., ?filter[model_name]=Mustang)
            const searchParams = new URLSearchParams(formData);
            url.search = searchParams.toString();

            // 3. Update the browser's address bar without reloading
            window.history.pushState({}, '', url);

            // 4. Fetch the new data asynchronously
            fetch(url, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest' // Standard Laravel AJAX header
                }
            })
            .then(response => response.text())
            .then(html => {
                // 5. Parse the returned HTML
                const parser = new DOMParser();
                const doc = parser.parseFromString(html, 'text/html');

                // 6. Swap ONLY the grid content. 
                // This preserves the sidebar and keeps the cursor focused in the search bar!
                document.getElementById('catalog-main-content').innerHTML = doc.getElementById('catalog-main-content').innerHTML;
            })
            .finally(() => {
                this.isSearching = false;
            });
        }
    }
}