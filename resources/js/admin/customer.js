document.addEventListener('DOMContentLoaded', () => {
    
    // 1. Optional: Auto-submit search when user types (debounced)
    const searchInput = document.querySelector('input[name="search"]');
    const searchForm = document.getElementById('search-form');
    let timeout = null;

    if (searchInput) {
        searchInput.addEventListener('keyup', function (e) {
            clearTimeout(timeout);
            // Submit form automatically after 500ms of typing
            timeout = setTimeout(function () {
                searchForm.submit();
            }, 500);
        });
    }

    // 2. Export Button Logic
    const exportBtn = document.getElementById('export-btn');
    if (exportBtn) {
        exportBtn.addEventListener('click', () => {
            // Replace this with your actual export route logic when ready
            alert('Export functionality will be connected to the Laravel Excel package shortly.');
            // window.location.href = '/admin/customers/export';
        });
    }
});