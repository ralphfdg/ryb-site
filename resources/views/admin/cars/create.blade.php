@extends('layouts.admin')

@section('content')
    <div class="flex items-center gap-3 mb-8">
        <a href="{{ route('admin.cars.index') }}" class="text-[#666] hover:text-white transition-colors">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
        </a>
        <div>
            <h2 class="text-2xl font-bold font-['Oswald'] tracking-wide uppercase mb-1">
                <span class="text-white">Add New</span> <span class="text-[#e52a2a]">Vehicle</span>
            </h2>
        </div>
    </div>

    {{-- Error Handling from StoreCarRequest --}}
    @if ($errors->any())
        <div class="bg-[#e52a2a]/10 border-l-4 border-[#e52a2a] text-[#ff8a80] p-4 mb-6 rounded text-sm">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.cars.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6 pb-20">
        @csrf

        {{-- Section 1: Core Details --}}
        <div class="bg-[#111111] p-6 rounded-xl border border-[#1a1a1a]">
            <h3 class="text-sm font-bold text-white tracking-widest uppercase mb-6 border-b border-[#1a1a1a] pb-3">Core Details</h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                
                <div>
                    <label class="block text-[10px] uppercase tracking-wider text-[#666] mb-2">Brand <span class="text-[#e52a2a]">*</span></label>
                    <select name="brand_id" required class="w-full bg-[#0a0a0a] border border-[#1a1a1a] rounded text-sm text-white px-4 py-2.5 focus:outline-none focus:border-[#e52a2a]">
                        <option value="">Select Brand</option>
                        @foreach($brands as $brand)
                            <option value="{{ $brand->id }}" {{ old('brand_id') == $brand->id ? 'selected' : '' }}>{{ $brand->brand_name }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-[10px] uppercase tracking-wider text-[#666] mb-2">Model Name <span class="text-[#e52a2a]">*</span></label>
                    <input type="text" name="model_name" value="{{ old('model_name') }}" required class="w-full bg-[#0a0a0a] border border-[#1a1a1a] rounded text-sm text-white px-4 py-2.5 focus:outline-none focus:border-[#e52a2a]">
                </div>

                <div>
                    <label class="block text-[10px] uppercase tracking-wider text-[#666] mb-2">Year <span class="text-[#e52a2a]">*</span></label>
                    <input type="number" name="year" value="{{ old('year', date('Y')) }}" required class="w-full bg-[#0a0a0a] border border-[#1a1a1a] rounded text-sm text-white px-4 py-2.5 focus:outline-none focus:border-[#e52a2a]">
                </div>

                <div>
                    <label class="block text-[10px] uppercase tracking-wider text-[#666] mb-2">Price (USD) <span class="text-[#e52a2a]">*</span></label>
                    <input type="number" step="0.01" name="price" value="{{ old('price') }}" required class="w-full bg-[#0a0a0a] border border-[#1a1a1a] rounded text-sm text-white px-4 py-2.5 focus:outline-none focus:border-[#e52a2a]">
                </div>

                <div>
                    <label class="block text-[10px] uppercase tracking-wider text-[#666] mb-2">Status <span class="text-[#e52a2a]">*</span></label>
                    <select name="status" required class="w-full bg-[#0a0a0a] border border-[#1a1a1a] rounded text-sm text-white px-4 py-2.5 focus:outline-none focus:border-[#e52a2a]">
                        <option value="Available" {{ old('status') == 'Available' ? 'selected' : '' }}>Available</option>
                        <option value="Reserved" {{ old('status') == 'Reserved' ? 'selected' : '' }}>Reserved</option>
                        <option value="Sold" {{ old('status') == 'Sold' ? 'selected' : '' }}>Sold</option>
                    </select>
                </div>

            </div>
        </div>

        {{-- Section 2: Technical Specifications --}}
        <div class="bg-[#111111] p-6 rounded-xl border border-[#1a1a1a]">
            <h3 class="text-sm font-bold text-white tracking-widest uppercase mb-6 border-b border-[#1a1a1a] pb-3">Technical Specifications</h3>
            <div class="grid grid-cols-1 md:grid-cols-4 gap-5">
                
                <div class="md:col-span-2">
                    <label class="block text-[10px] uppercase tracking-wider text-[#666] mb-2">VIN Number <span class="text-[#e52a2a]">*</span></label>
                    <input type="text" name="vin_number" value="{{ old('vin_number') }}" required maxlength="17" class="w-full bg-[#0a0a0a] border border-[#1a1a1a] rounded text-sm text-white px-4 py-2.5 focus:outline-none focus:border-[#e52a2a] font-mono uppercase">
                </div>

                <div>
                    <label class="block text-[10px] uppercase tracking-wider text-[#666] mb-2">Mileage <span class="text-[#e52a2a]">*</span></label>
                    <input type="number" name="mileage" value="{{ old('mileage') }}" required class="w-full bg-[#0a0a0a] border border-[#1a1a1a] rounded text-sm text-white px-4 py-2.5 focus:outline-none focus:border-[#e52a2a]">
                </div>

                <div>
                    <label class="block text-[10px] uppercase tracking-wider text-[#666] mb-2">Transmission <span class="text-[#e52a2a]">*</span></label>
                    <select name="transmission" required class="w-full bg-[#0a0a0a] border border-[#1a1a1a] rounded text-sm text-white px-4 py-2.5 focus:outline-none focus:border-[#e52a2a]">
                        <option value="Automatic" {{ old('transmission') == 'Automatic' ? 'selected' : '' }}>Automatic</option>
                        <option value="Manual" {{ old('transmission') == 'Manual' ? 'selected' : '' }}>Manual</option>
                    </select>
                </div>

                <div>
                    <label class="block text-[10px] uppercase tracking-wider text-[#666] mb-2">Fuel Type <span class="text-[#e52a2a]">*</span></label>
                    <select name="fuel_type" required class="w-full bg-[#0a0a0a] border border-[#1a1a1a] rounded text-sm text-white px-4 py-2.5 focus:outline-none focus:border-[#e52a2a]">
                        <option value="Gasoline" {{ old('fuel_type') == 'Gasoline' ? 'selected' : '' }}>Gasoline</option>
                        <option value="Diesel" {{ old('fuel_type') == 'Diesel' ? 'selected' : '' }}>Diesel</option>
                        <option value="Hybrid" {{ old('fuel_type') == 'Hybrid' ? 'selected' : '' }}>Hybrid</option>
                        <option value="Electric" {{ old('fuel_type') == 'Electric' ? 'selected' : '' }}>Electric</option>
                    </select>
                </div>

                <div>
                    <label class="block text-[10px] uppercase tracking-wider text-[#666] mb-2">Engine Type <span class="text-[#e52a2a]">*</span></label>
                    <input type="text" name="engine_type" value="{{ old('engine_type') }}" placeholder="e.g. 2.0L Inline 4" required class="w-full bg-[#0a0a0a] border border-[#1a1a1a] rounded text-sm text-white px-4 py-2.5 focus:outline-none focus:border-[#e52a2a]">
                </div>

                <div>
                    <label class="block text-[10px] uppercase tracking-wider text-[#666] mb-2">Exterior Color</label>
                    <input type="text" name="color_exterior" value="{{ old('color_exterior') }}" required class="w-full bg-[#0a0a0a] border border-[#1a1a1a] rounded text-sm text-white px-4 py-2.5 focus:outline-none focus:border-[#e52a2a]">
                </div>

                <div>
                    <label class="block text-[10px] uppercase tracking-wider text-[#666] mb-2">Interior Color</label>
                    <input type="text" name="color_interior" value="{{ old('color_interior') }}" required class="w-full bg-[#0a0a0a] border border-[#1a1a1a] rounded text-sm text-white px-4 py-2.5 focus:outline-none focus:border-[#e52a2a]">
                </div>

                <div>
                    <label class="block text-[10px] uppercase tracking-wider text-[#666] mb-2">Fuel Capacity</label>
                    <input type="text" name="fuel_capacity" value="{{ old('fuel_capacity') }}" placeholder="e.g. 15 Gallons" required class="w-full bg-[#0a0a0a] border border-[#1a1a1a] rounded text-sm text-white px-4 py-2.5 focus:outline-none focus:border-[#e52a2a]">
                </div>
            </div>
        </div>

        {{-- Section 3: Media & Description --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="bg-[#111111] p-6 rounded-xl border border-[#1a1a1a]">
                <h3 class="text-sm font-bold text-white tracking-widest uppercase mb-4">Description</h3>
                <textarea name="description" rows="7" required class="w-full bg-[#0a0a0a] border border-[#1a1a1a] rounded text-sm text-white px-4 py-3 focus:outline-none focus:border-[#e52a2a] resize-none">{{ old('description') }}</textarea>
            </div>

            <div class="bg-[#111111] p-6 rounded-xl border border-[#1a1a1a]">
                <h3 class="text-sm font-bold text-white tracking-widest uppercase mb-4">Vehicle Images <span class="text-[#e52a2a]">*</span></h3>
                
                <div class="relative border-2 border-dashed border-[#1a1a1a] rounded-lg bg-[#0a0a0a] hover:border-[#e52a2a] transition-colors p-6 flex flex-col items-center justify-center cursor-pointer" id="image-drop-zone">
                    <svg class="w-8 h-8 text-[#666] mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path></svg>
                    <p class="text-xs text-[#a0a0a0] text-center mb-1"><span class="text-[#e52a2a] font-bold">Click to upload</span> or drag and drop</p>
                    <p class="text-[9px] text-[#666] uppercase tracking-wider">PNG, JPG up to 5MB (Max 10)</p>
                    <input type="file" name="images[]" id="images" multiple accept="image/*" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer" required>
                </div>

                {{-- Container for JS injected image previews --}}
                <div id="image-preview-container" class="mt-4 grid grid-cols-4 gap-2"></div>
            </div>
        </div>

        <div class="flex justify-end pt-4">
            <button type="submit" class="bg-[#e52a2a] hover:bg-red-700 text-white px-8 py-3 rounded-md text-sm font-bold tracking-wider uppercase transition-colors shadow-[0_0_20px_rgba(229,42,42,0.4)]">
                Save Vehicle to Inventory
            </button>
        </div>
    </form>

    {{-- Import the separated JS via Vite --}}
    @vite(['resources/js/admin/car-form.js'])
@endsection