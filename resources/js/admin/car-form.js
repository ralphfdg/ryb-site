document.addEventListener('DOMContentLoaded', function() {
    const fileInput = document.getElementById('images');
    const previewContainer = document.getElementById('image-preview-container');
    const dropZone = document.getElementById('image-drop-zone');

    if (!fileInput) return;

    // Handle File Selection
    fileInput.addEventListener('change', function(e) {
        previewContainer.innerHTML = ''; // Clear previous previews
        const files = Array.from(e.target.files);

        // Max limit validation (matching our FormRequest)
        if (files.length > 10) {
            alert('You can only upload a maximum of 10 images.');
            fileInput.value = ''; // Reset
            return;
        }

        files.forEach(file => {
            if (!file.type.match('image.*')) return;

            const reader = new FileReader();
            reader.onload = function(e) {
                const imgWrap = document.createElement('div');
                imgWrap.className = 'relative w-full h-16 rounded border border-[#333] overflow-hidden';
                
                const img = document.createElement('img');
                img.src = e.target.result;
                img.className = 'w-full h-full object-cover';
                
                imgWrap.appendChild(img);
                previewContainer.appendChild(imgWrap);
            }
            reader.readAsDataURL(file);
        });
    });

    // Optional: Visual feedback for Drag & Drop
    ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
        dropZone.addEventListener(eventName, preventDefaults, false);
    });

    function preventDefaults(e) {
        e.preventDefault();
        e.stopPropagation();
    }

    ['dragenter', 'dragover'].forEach(eventName => {
        dropZone.addEventListener(eventName, () => dropZone.classList.add('border-[#e52a2a]'), false);
    });

    ['dragleave', 'drop'].forEach(eventName => {
        dropZone.addEventListener(eventName, () => dropZone.classList.remove('border-[#e52a2a]'), false);
    });
});