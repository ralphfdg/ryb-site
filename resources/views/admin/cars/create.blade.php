@extends('layouts.admin')

@section('content')
    <!-- Ambient Background Shapes -->
    <div class="fixed top-0 left-0 w-full h-full overflow-hidden pointer-events-none z-0">
        <div class="absolute top-[10%] right-[10%] w-[600px] h-[600px] rounded-full bg-[#e52a2a]/10 blur-[150px]"></div>
        <div class="absolute bottom-[-10%] left-[-5%] w-[500px] h-[500px] rounded-full bg-[#e52a2a]/5 blur-[120px]"></div>
    </div>

    <div class="max-w-5xl mx-auto relative z-10 pt-4 pb-12">
        <div class="flex justify-between items-end mb-8">
            <div>
                <h2 class="text-3xl font-bold font-['Oswald'] tracking-wide uppercase mb-1">
                    <span class="text-white">Add New</span> <span class="text-[#e52a2a]">Vehicle</span>
                </h2>
                <p class="text-[#666] text-sm">Populate the primary inventory and technical specification records.</p>
            </div>
            <a href="{{ route('admin.cars.index') }}" class="text-[#888] hover:text-white text-xs transition-colors flex items-center gap-2 bg-[#111]/80 px-4 py-2 rounded-lg border border-[#222]">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Cancel & Return
            </a>
        </div>

        @if ($errors->any())
            <div class="mb-6 bg-[#2a0808] border border-[#e52a2a]/50 text-[#e52a2a] px-6 py-4 rounded-xl text-sm backdrop-blur-md">
                <p class="font-bold mb-2 flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                    Please fix the following errors:
                </p>
                <ul class="list-disc list-inside ml-4">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.cars.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <!-- Section 1: General Details -->
            <div class="bg-[#111111]/70 backdrop-blur-xl rounded-2xl border border-[#222] shadow-xl p-8">
                <h3 class="text-[#e52a2a] text-[11px] font-bold uppercase tracking-widest mb-6 border-b border-[#222] pb-2">Part 1: General Information</h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-xs font-bold text-[#888] uppercase tracking-widest mb-2">Manufacturer Brand</label>
                        <select name="brand_id" required class="w-full bg-[#050505] border border-[#333] text-white text-sm rounded-xl focus:ring-1 focus:ring-[#e52a2a] focus:border-[#e52a2a] px-4 py-3">
                            <option value="">Select Brand...</option>
                            @foreach($brands as $brand)
                                <option value="{{ $brand->id }}" {{ old('brand_id') == $brand->id ? 'selected' : '' }}>{{ $brand->brand_name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-[#888] uppercase tracking-widest mb-2">Body Type</label>
                        <select name="car_type_id" class="w-full bg-[#050505] border border-[#333] text-white text-sm rounded-xl focus:ring-1 focus:ring-[#e52a2a] focus:border-[#e52a2a] px-4 py-3">
                            <option value="">Select Type (Optional)...</option>
                            @foreach($carTypes as $type)
                                <option value="{{ $type->id }}" {{ old('car_type_id') == $type->id ? 'selected' : '' }}>{{ $type->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-xs font-bold text-[#888] uppercase tracking-widest mb-2">Model Name</label>
                        <input type="text" name="model_name" value="{{ old('model_name') }}" required maxlength="191" placeholder="e.g. Civic Type R" class="w-full bg-[#050505] border border-[#333] text-white text-sm rounded-xl px-4 py-3 focus:ring-1 focus:ring-[#e52a2a] focus:border-[#e52a2a]">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-[#888] uppercase tracking-widest mb-2">Year</label>
                        <input type="number" name="year" value="{{ old('year') }}" required min="1900" max="{{ date('Y') + 1 }}" class="w-full bg-[#050505] border border-[#333] text-white text-sm rounded-xl px-4 py-3 focus:ring-1 focus:ring-[#e52a2a]">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-[#888] uppercase tracking-widest mb-2">Price (PHP)</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-[#e52a2a] font-bold">₱</span>
                            <input type="number" name="price" value="{{ old('price') }}" required step="0.01" min="0" class="w-full bg-[#050505] border border-[#333] text-white text-sm rounded-xl pl-8 pr-4 py-3 focus:ring-1 focus:ring-[#e52a2a]">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Section 2: Technical Specifications -->
            <div class="bg-[#111111]/70 backdrop-blur-xl rounded-2xl border border-[#222] shadow-xl p-8">
                <h3 class="text-[#e52a2a] text-[11px] font-bold uppercase tracking-widest mb-6 border-b border-[#222] pb-2">Part 2: Specifications</h3>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="md:col-span-3">
                        <label class="block text-xs font-bold text-[#888] uppercase tracking-widest mb-2">VIN Number (17 Chars)</label>
                        <input type="text" name="vin_number" value="{{ old('vin_number') }}" required maxlength="17" class="w-full bg-[#050505] border border-[#333] text-white text-sm rounded-xl px-4 py-3 font-mono uppercase focus:ring-1 focus:ring-[#e52a2a]">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-[#888] uppercase tracking-widest mb-2">Transmission</label>
                        <select name="transmission" required class="w-full bg-[#050505] border border-[#333] text-white text-sm rounded-xl px-4 py-3 focus:ring-1 focus:ring-[#e52a2a]">
                            <option value="Automatic" {{ old('transmission') == 'Automatic' ? 'selected' : '' }}>Automatic</option>
                            <option value="Manual" {{ old('transmission') == 'Manual' ? 'selected' : '' }}>Manual</option>
                            <option value="CVT" {{ old('transmission') == 'CVT' ? 'selected' : '' }}>CVT</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-[#888] uppercase tracking-widest mb-2">Fuel Type</label>
                        <select name="fuel_type" required class="w-full bg-[#050505] border border-[#333] text-white text-sm rounded-xl px-4 py-3 focus:ring-1 focus:ring-[#e52a2a]">
                            <option value="Gasoline" {{ old('fuel_type') == 'Gasoline' ? 'selected' : '' }}>Gasoline</option>
                            <option value="Diesel" {{ old('fuel_type') == 'Diesel' ? 'selected' : '' }}>Diesel</option>
                            <option value="Hybrid" {{ old('fuel_type') == 'Hybrid' ? 'selected' : '' }}>Hybrid</option>
                            <option value="Electric" {{ old('fuel_type') == 'Electric' ? 'selected' : '' }}>Electric</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-[#888] uppercase tracking-widest mb-2">Engine Type</label>
                        <input type="text" name="engine_type" value="{{ old('engine_type') }}" required placeholder="e.g. 2.0L Turbo I4" class="w-full bg-[#050505] border border-[#333] text-white text-sm rounded-xl px-4 py-3 focus:ring-1 focus:ring-[#e52a2a]">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-[#888] uppercase tracking-widest mb-2">Exterior Color</label>
                        <input type="text" name="color_exterior" value="{{ old('color_exterior') }}" required class="w-full bg-[#050505] border border-[#333] text-white text-sm rounded-xl px-4 py-3 focus:ring-1 focus:ring-[#e52a2a]">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-[#888] uppercase tracking-widest mb-2">Interior Color</label>
                        <input type="text" name="color_interior" value="{{ old('color_interior') }}" required class="w-full bg-[#050505] border border-[#333] text-white text-sm rounded-xl px-4 py-3 focus:ring-1 focus:ring-[#e52a2a]">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-[#888] uppercase tracking-widest mb-2">Fuel Capacity</label>
                        <input type="text" name="fuel_capacity" value="{{ old('fuel_capacity') }}" required placeholder="e.g. 50L" class="w-full bg-[#050505] border border-[#333] text-white text-sm rounded-xl px-4 py-3 focus:ring-1 focus:ring-[#e52a2a]">
                    </div>
                </div>
            </div>

            <!-- Section 3: History & Features -->
            <div class="bg-[#111111]/70 backdrop-blur-xl rounded-2xl border border-[#222] shadow-xl p-8">
                <h3 class="text-[#e52a2a] text-[11px] font-bold uppercase tracking-widest mb-6 border-b border-[#222] pb-2">Part 3: History & Status</h3>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                    <div>
                        <label class="block text-xs font-bold text-[#888] uppercase tracking-widest mb-2">Mileage (km)</label>
                        <input type="number" name="mileage" value="{{ old('mileage') }}" required min="0" class="w-full bg-[#050505] border border-[#333] text-white text-sm rounded-xl px-4 py-3 focus:ring-1 focus:ring-[#e52a2a]">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-[#888] uppercase tracking-widest mb-2">Previous Owners</label>
                        <input type="number" name="previous_owners" value="{{ old('previous_owners', 0) }}" required min="0" class="w-full bg-[#050505] border border-[#333] text-white text-sm rounded-xl px-4 py-3 focus:ring-1 focus:ring-[#e52a2a]">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-[#888] uppercase tracking-widest mb-2">Plate Ending (0-9)</label>
                        <input type="number" name="plate_ending" value="{{ old('plate_ending') }}" required min="0" max="9" class="w-full bg-[#050505] border border-[#333] text-white text-sm rounded-xl px-4 py-3 focus:ring-1 focus:ring-[#e52a2a]">
                    </div>
                </div>

                <div class="mb-6">
                    <label class="block text-xs font-bold text-[#888] uppercase tracking-widest mb-2">Features (Comma Separated)</label>
                    <textarea name="features" rows="3" placeholder="Leather Seats, Sunroof, Apple CarPlay, Backup Camera" class="w-full bg-[#050505] border border-[#333] text-white text-sm rounded-xl px-4 py-3 focus:ring-1 focus:ring-[#e52a2a]">{{ old('features') }}</textarea>
                    <p class="text-[10px] text-[#555] mt-1">These will be converted into a JSON array for the catalog view.</p>
                </div>

                <div class="flex items-center gap-6">
                    <div class="flex-1">
                        <label class="block text-xs font-bold text-[#888] uppercase tracking-widest mb-2">Initial Status</label>
                        <select name="status" required class="w-full bg-[#050505] border border-[#333] text-[#2ecc71] font-bold tracking-wider text-sm rounded-xl px-4 py-3 focus:ring-1 focus:ring-[#e52a2a]">
                            <option value="Available" selected>AVAILABLE</option>
                            <option value="Reserved" class="text-[#f39c12]">RESERVED</option>
                            <option value="Sold" class="text-[#e52a2a]">SOLD</option>
                        </select>
                    </div>
                    <div class="flex items-center mt-6">
                        <input type="checkbox" id="is_featured" name="is_featured" value="1" {{ old('is_featured') ? 'checked' : '' }} class="w-5 h-5 bg-[#050505] border-[#333] text-[#e52a2a] rounded focus:ring-[#e52a2a]">
                        <label for="is_featured" class="ml-3 text-sm font-bold text-white tracking-wide cursor-pointer">Feature on Homepage</label>
                    </div>
                </div>
            </div>

            <!-- Section 4: Image Gallery (Alpine.js Multi-Uploader) -->
            <div class="bg-[#111111]/70 backdrop-blur-xl rounded-2xl border border-[#222] shadow-xl p-8" x-data="multiImageUploader()">
                <h3 class="text-[#e52a2a] text-[11px] font-bold uppercase tracking-widest mb-6 border-b border-[#222] pb-2">Part 4: Media Gallery</h3>
                
                <div 
                    @dragover.prevent="isDragging = true" 
                    @dragleave.prevent="isDragging = false" 
                    @drop.prevent="handleDrop"
                    :class="isDragging ? 'border-[#e52a2a] bg-[#e52a2a]/5' : 'border-[#333] bg-[#050505] hover:border-[#e52a2a]/50'"
                    class="relative flex flex-col items-center justify-center w-full min-h-[250px] border-2 border-dashed rounded-xl transition-all duration-300 p-6 cursor-pointer"
                    @click="$refs.fileInput.click()"
                >
                    <input x-ref="fileInput" id="images" name="images[]" type="file" multiple class="hidden" accept="image/*" @change="handleFileChange" />
                    
                    <div x-show="previewUrls.length === 0" class="flex flex-col items-center justify-center py-8 text-center pointer-events-none">
                        <div class="w-16 h-16 mb-4 rounded-full bg-[#1a1a1a] border border-[#333] flex items-center justify-center">
                            <svg class="w-8 h-8 text-[#888]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        </div>
                        <p class="mb-2 text-sm text-[#888]"><span class="font-bold text-white">Click to select</span> or drag multiple images</p>
                        <p class="text-xs text-[#555]">Hold CTRL/CMD to select multiple files.</p>
                    </div>

                    <div x-show="previewUrls.length > 0" class="w-full grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-4 pointer-events-none" style="display: none;">
                        <template x-for="(url, index) in previewUrls" :key="index">
                            <div class="relative aspect-video rounded-lg overflow-hidden border border-[#333] shadow-lg">
                                <img :src="url" class="w-full h-full object-cover">
                            </div>
                        </template>
                    </div>
                </div>

                <div x-show="previewUrls.length > 0" class="mt-4 flex justify-between items-center" style="display: none;">
                    <span class="text-xs text-[#2ecc71] font-bold"><span x-text="previewUrls.length"></span> image(s) queued for upload.</span>
                    <button type="button" @click.prevent="clearFiles" class="text-xs text-[#e52a2a] hover:underline font-bold uppercase tracking-wider">Clear All Images</button>
                </div>
            </div>

            <div class="pt-6 flex justify-end">
                <button type="submit" class="bg-[#e52a2a] hover:bg-[#c92222] text-white text-sm font-bold uppercase tracking-widest px-12 py-4 rounded-xl shadow-[0_0_20px_rgba(229,42,42,0.3)] transition-all hover:scale-[1.02] flex items-center gap-3">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                    Commit to Database
                </button>
            </div>
        </form>
    </div>

    <!-- Alpine.js Multi-Uploader Component -->
    <script>
        document.addEventListener('alpine:init', () => {
            if (!Alpine.data('multiImageUploader')) {
                Alpine.data('multiImageUploader', () => ({
                    isDragging: false,
                    previewUrls: [],
                    
                    handleFileChange(event) {
                        this.processFiles(event.target.files);
                    },
                    
                    handleDrop(event) {
                        this.isDragging = false;
                        const files = event.dataTransfer.files;
                        if (files.length > 0) {
                            this.$refs.fileInput.files = files;
                            this.processFiles(files);
                        }
                    },
                    
                    processFiles(files) {
                        this.previewUrls = []; 
                        Array.from(files).forEach(file => {
                            if (file.type.startsWith('image/')) {
                                const reader = new FileReader();
                                reader.onload = (e) => {
                                    this.previewUrls.push(e.target.result);
                                };
                                reader.readAsDataURL(file);
                            }
                        });
                    },
                    
                    clearFiles() {
                        this.previewUrls = [];
                        this.$refs.fileInput.value = '';
                    }
                }));
            }
        });
    </script>
@endsection