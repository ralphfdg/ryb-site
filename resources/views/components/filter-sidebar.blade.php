@props(['actionRoute', 'brands', 'carTypes', 'filterOptions'])

<aside class="w-full lg:w-[340px] shrink-0 z-20">
    <div class="bg-white/5 backdrop-blur-xl border border-white/10 rounded-3xl p-6 sticky top-28 shadow-2xl shadow-black/80">
        <h2 class="text-sm font-bold text-white mb-6 uppercase tracking-wider border-b border-white/10 pb-4 flex items-center gap-2">
            <svg class="w-4 h-4 text-ryb-red" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path></svg>
            Refine Search
        </h2>

        <form id="filterForm" x-ref="filterForm" @submit.prevent="submitForm()" action="{{ $actionRoute }}" method="GET" class="space-y-6">
            
            {{-- Search Model --}}
            <div>
                <label class="block text-xs font-bold text-zinc-400 mb-2 uppercase tracking-wider">Model Search</label>
                <div class="relative">
                    <input type="text" name="filter[model_name]" value="{{ request()->input('filter.model_name') }}"
                           placeholder="e.g. Mustang" @input.debounce.500ms="submitForm()"
                           class="w-full bg-black/40 border border-white/10 text-white rounded-xl pl-10 pr-4 py-3 outline-none focus:border-ryb-red transition backdrop-blur-sm shadow-inner">
                    <svg class="w-4 h-4 text-zinc-500 absolute left-4 top-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </div>
            </div>

            {{-- Brand & Year --}}
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold text-zinc-400 mb-2 uppercase tracking-wider">Brand</label>
                    <select name="filter[brand_id]" @change="submitForm()" class="w-full bg-black/40 border border-white/10 text-white rounded-xl px-3 py-3 outline-none [&>option]:bg-ryb-darker cursor-pointer shadow-inner">
                        <option value="">All Brands</option>
                        @foreach($brands as $brand)
                            <option value="{{ $brand->id }}" {{ request()->input('filter.brand_id') == $brand->id ? 'selected' : '' }}>{{ $brand->brand_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-bold text-zinc-400 mb-2 uppercase tracking-wider">Year</label>
                    <select name="filter[year]" @change="submitForm()" class="w-full bg-black/40 border border-white/10 text-white rounded-xl px-3 py-3 outline-none [&>option]:bg-ryb-darker cursor-pointer shadow-inner">
                        <option value="">Any</option>
                        @for($i = date('Y'); $i >= 2000; $i--)
                            <option value="{{ $i }}" {{ request()->input('filter.year') == $i ? 'selected' : '' }}>{{ $i }}</option>
                        @endfor
                    </select>
                </div>
            </div>

            {{-- Alpine reactive mileage slider --}}
            <div x-data="{ mileage: {{ request('filter.mileage', 150000) }} }" class="pt-2">
                <div class="flex justify-between items-end mb-2">
                    <label class="block text-xs font-bold text-zinc-400 uppercase tracking-wider">Max Mileage</label>
                    <span class="text-sm font-bold text-ryb-red" x-text="new Intl.NumberFormat().format(mileage) + ' km'"></span>
                </div>
                <input type="range" name="filter[mileage]" min="0" max="150000" step="5000" 
                       x-model="mileage" 
                       @change="submitForm()"
                       class="w-full h-1.5 bg-ryb-muted rounded-lg appearance-none cursor-pointer accent-ryb-red">
            </div>

            {{-- Technical Specs Toggle --}}
            <div x-data="{ showAdvanced: {{ request()->hasAny(['filter.transmission', 'filter.fuel_type', 'filter.color_exterior', 'filter.plate_ending']) ? 'true' : 'false' }} }" class="pt-2 border-t border-white/10">
                <button type="button" @click="showAdvanced = !showAdvanced" class="w-full flex items-center justify-between text-xs font-bold text-zinc-300 uppercase tracking-wider py-2 hover:text-white transition">
                    Technical Specifications
                    <svg class="w-4 h-4 transition-transform duration-300" :class="showAdvanced ? 'rotate-180 text-ryb-red' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M19 9l-7 7-7-7" stroke-width="2"></path></svg>
                </button>

                <div x-show="showAdvanced" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 -translate-y-2" x-transition:enter-end="opacity-100 translate-y-0" class="space-y-5 pt-5 pb-2" style="display: none;">
                    
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-[10px] font-bold text-zinc-500 mb-1.5 uppercase tracking-wider">Transmission</label>
                            <select name="filter[transmission]" @change="submitForm()" class="w-full bg-black/20 border border-white/10 text-white rounded-lg px-2 py-2 text-sm outline-none cursor-pointer [&>option]:bg-ryb-darker">
                                <option value="">Any</option>
                                @foreach($filterOptions['transmissions'] as $trans)
                                    <option value="{{ $trans }}" {{ request('filter.transmission') == $trans ? 'selected' : '' }}>{{ $trans }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="block text-[10px] font-bold text-zinc-500 mb-1.5 uppercase tracking-wider">Fuel Type</label>
                            <select name="filter[fuel_type]" @change="submitForm()" class="w-full bg-black/20 border border-white/10 text-white rounded-lg px-2 py-2 text-sm outline-none cursor-pointer [&>option]:bg-ryb-darker">
                                <option value="">Any</option>
                                @foreach($filterOptions['fuels'] as $fuel)
                                    <option value="{{ $fuel }}" {{ request('filter.fuel_type') == $fuel ? 'selected' : '' }}>{{ $fuel }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-[10px] font-bold text-zinc-500 mb-1.5 uppercase tracking-wider">Engine Type</label>
                            <select name="filter[engine_type]" @change="submitForm()" class="w-full bg-black/20 border border-white/10 text-white rounded-lg px-2 py-2 text-sm outline-none cursor-pointer [&>option]:bg-ryb-darker">
                                <option value="">Any</option>
                                @foreach($filterOptions['engines'] as $engine)
                                    <option value="{{ $engine }}" {{ request('filter.engine_type') == $engine ? 'selected' : '' }}>{{ $engine }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="block text-[10px] font-bold text-zinc-500 mb-1.5 uppercase tracking-wider">Exterior Color</label>
                            <select name="filter[color_exterior]" @change="submitForm()" class="w-full bg-black/20 border border-white/10 text-white rounded-lg px-2 py-2 text-sm outline-none cursor-pointer [&>option]:bg-ryb-darker">
                                <option value="">Any Color</option>
                                @foreach($filterOptions['colors'] as $color)
                                    <option value="{{ $color }}" {{ request('filter.color_exterior') == $color ? 'selected' : '' }}>{{ $color }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div>
                        <label class="block text-[10px] font-bold text-zinc-500 mb-2 uppercase tracking-wider">Plate Ending (Coding)</label>
                        <div class="grid grid-cols-5 gap-1.5">
                            @for($i = 0; $i <= 9; $i++)
                                <label class="cursor-pointer">
                                    {{-- ADDED "peer" class to the input --}}
                                    <input type="radio" name="filter[plate_ending]" value="{{ $i }}" class="hidden peer" @change="submitForm()" {{ request('filter.plate_ending') == "$i" ? 'checked' : '' }}>
                                    
                                    {{-- REMOVED Blade styling logic. ADDED peer-checked Tailwind logic --}}
                                    <div class="py-1.5 text-center border rounded-lg text-sm font-medium transition bg-black/20 border-white/10 text-zinc-500 hover:text-white hover:border-white/30 peer-checked:bg-ryb-red peer-checked:border-ryb-red peer-checked:text-white peer-checked:shadow-[0_0_10px_rgba(220,38,38,0.4)]">
                                        {{ $i }}
                                    </div>
                                </label>
                            @endfor
                        </div>
                    </div>
                </div>
            </div>

            {{-- REMOVED the @if wrapper so the button is always available --}}
            <div class="pt-4 mt-4 border-t border-white/10">
                <a href="{{ $actionRoute }}" class="block w-full text-center py-3 bg-zinc-800 hover:bg-zinc-700 text-white font-bold rounded-xl transition text-sm shadow-md">
                    Clear All Filters
                </a>
            </div>
        </form>
    </div>
</aside>