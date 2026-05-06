@extends('layouts.admin')

@section('content')
    <!-- Ambient Background Shapes -->
    <div class="fixed top-0 left-0 w-full h-full overflow-hidden pointer-events-none z-0">
        <div class="absolute top-[-10%] right-[-5%] w-[500px] h-[500px] rounded-full bg-[#e52a2a]/10 blur-[120px]"></div>
        <div class="absolute bottom-[-20%] left-[-10%] w-[600px] h-[600px] rounded-full bg-[#e52a2a]/5 blur-[150px]"></div>
    </div>

    <!-- Centered Form Container -->
    <div class="max-w-3xl mx-auto relative z-10 pt-8">
        
        <!-- Header -->
        <div class="flex justify-between items-end mb-8">
            <div>
                <h2 class="text-3xl font-bold font-['Oswald'] tracking-wide uppercase mb-1">
                    <span class="text-white">Edit</span> <span class="text-[#e52a2a]">{{ $brand->brand_name }}</span>
                </h2>
                <p class="text-[#666] text-sm">Update manufacturer details or replace the official logo.</p>
            </div>
            <a href="{{ route('admin.brands.index') }}" class="text-[#888] hover:text-white text-xs transition-colors flex items-center gap-2 bg-[#111]/80 px-4 py-2 rounded-lg border border-[#222]">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Back to Directory
            </a>
        </div>

        <!-- Glassmorphism Form Card -->
        <div class="bg-[#111111]/70 backdrop-blur-xl rounded-2xl border border-[#222] shadow-2xl p-8 lg:p-10">
            <form action="{{ route('admin.brands.update', $brand) }}" method="POST" enctype="multipart/form-data" class="space-y-8">
                @csrf
                @method('PUT')

                <!-- Brand Name Input -->
                <div>
                    <label for="brand_name" class="block text-xs font-bold text-[#888] uppercase tracking-widest mb-3">Manufacturer Name</label>
                    <input type="text" id="brand_name" name="brand_name" value="{{ old('brand_name', $brand->brand_name) }}" required
                        class="w-full bg-[#050505]/50 border border-[#333] text-white text-base rounded-xl focus:ring-1 focus:ring-[#e52a2a] focus:border-[#e52a2a] px-5 py-4 transition-all shadow-inner">
                    @error('brand_name')
                        <p class="text-[#e52a2a] text-xs mt-2 font-medium flex items-center gap-1">
                            <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Interactive Drag & Drop Logo Upload -->
                <div x-data="imageUploader('{{ $brand->getFirstMediaUrl('brand_logos') ?: '' }}')">
                    <label class="block text-xs font-bold text-[#888] uppercase tracking-widest mb-3">Brand Logo</label>
                    
                    <div 
                        @dragover.prevent="isDragging = true" 
                        @dragleave.prevent="isDragging = false" 
                        @drop.prevent="handleDrop"
                        :class="isDragging ? 'border-[#e52a2a] bg-[#e52a2a]/5' : 'border-[#333] bg-[#050505]/50 hover:border-[#e52a2a]/50'"
                        class="relative flex flex-col items-center justify-center w-full min-h-[200px] border-2 border-dashed rounded-xl transition-all duration-300 overflow-hidden cursor-pointer group"
                        @click="$refs.fileInput.click()"
                    >
                        <!-- Hidden File Input -->
                        <input x-ref="fileInput" id="logo" name="logo" type="file" class="hidden" accept="image/*" @change="handleFileChange" />
                        
                        <!-- Default Upload Prompt (Hidden if preview exists) -->
                        <div x-show="!previewUrl" class="flex flex-col items-center justify-center py-8 text-center" x-transition>
                            <div class="w-16 h-16 mb-4 rounded-full bg-[#1a1a1a] border border-[#333] flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                                <svg class="w-8 h-8 text-[#888] group-hover:text-[#e52a2a] transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path></svg>
                            </div>
                            <p class="mb-2 text-sm text-[#888]"><span class="font-bold text-white">Click to upload</span> or drag and drop</p>
                            <p class="text-xs text-[#555]">Upload a new file to replace the current logo (Max. 2MB)</p>
                        </div>

                        <!-- Image Preview -->
                        <div x-show="previewUrl" class="absolute inset-0 w-full h-full bg-[#050505] flex items-center justify-center p-4 z-10" style="display: none;">
                            <img :src="previewUrl" class="max-h-full max-w-full object-contain drop-shadow-2xl">
                            
                            <!-- Remove/Replace Image Overlay -->
                            <div class="absolute inset-0 bg-black/60 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center backdrop-blur-sm">
                                <button type="button" @click.stop="removeFile" class="bg-[#e52a2a] hover:bg-[#c92222] text-white px-4 py-2 rounded font-bold text-xs uppercase tracking-wider flex items-center gap-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path></svg>
                                    Replace Logo
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- File Details Meta -->
                    <div x-show="fileName" class="mt-3 flex justify-between items-center text-xs text-[#666]" style="display: none;">
                        <span x-text="'New File: ' + fileName" class="truncate max-w-[200px] font-medium text-[#aaa]"></span>
                        <span x-text="fileSize"></span>
                    </div>

                    @error('logo')
                        <p class="text-[#e52a2a] text-xs mt-2 font-medium flex items-center gap-1">
                            <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div class="pt-6 border-t border-[#222] flex justify-end">
                    <button type="submit" class="bg-[#e52a2a] hover:bg-[#c92222] text-white text-sm font-bold uppercase tracking-widest px-10 py-4 rounded-xl shadow-[0_0_15px_rgba(229,42,42,0.3)] transition-all hover:scale-[1.02]">
                        Apply Updates
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Alpine.js Component Logic -->
    <script>
        document.addEventListener('alpine:init', () => {
            // Check if the component is already defined to prevent redeclaration errors
            if (!Alpine.data('imageUploader')) {
                Alpine.data('imageUploader', (existingUrl = null) => ({
                    isDragging: false,
                    previewUrl: existingUrl,
                    fileName: null,
                    fileSize: null,
                    
                    handleFileChange(event) {
                        const file = event.target.files[0];
                        this.processFile(file);
                    },
                    
                    handleDrop(event) {
                        this.isDragging = false;
                        const file = event.dataTransfer.files[0];
                        if (file && file.type.startsWith('image/')) {
                            // Sync dragged file to the hidden input
                            this.$refs.fileInput.files = event.dataTransfer.files;
                            this.processFile(file);
                        }
                    },
                    
                    processFile(file) {
                        if (!file) return;
                        this.fileName = file.name;
                        this.fileSize = (file.size / 1024 / 1024).toFixed(2) + ' MB';
                        
                        const reader = new FileReader();
                        reader.onload = (e) => {
                            this.previewUrl = e.target.result;
                        };
                        reader.readAsDataURL(file);
                    },
                    
                    removeFile() {
                        this.previewUrl = null; 
                        this.fileName = null;
                        this.fileSize = null;
                        this.$refs.fileInput.value = '';
                    }
                }));
            }
        });
    </script>
@endsection