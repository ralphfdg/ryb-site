<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;

class BrandController extends Controller
{
    /**
     * Display a listing of the brands.
     */
    public function index(): View
    {
        // Eager load media polymorphic relationship to prevent N+1 queries
        $brands = Brand::with('media')->latest()->paginate(10);
        
        return view('admin.brands.index', compact('brands'));
    }

    /**
     * Display the specified brand and its associated inventory.
     */
    public function show(Brand $brand): View
    {
        // Eager load associated cars and their media to prevent N+1 queries 
        // when iterating through the brand's catalog in the view.
        $brand->load(['cars.media', 'media']);
        
        return view('admin.brands.show', compact('brand'));
    }

    /**
     * Show the form for creating a new brand.
     */
    public function create(): View
    {
        return view('admin.brands.create');
    }

    /**
     * Store a newly created brand in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            // Enforcing the 100 character constraint from the Data Dictionary[cite: 1]
            'brand_name' => 'required|string|max:100|unique:brands,brand_name',
            'logo'       => 'nullable|image|mimes:jpeg,png,jpg,svg,webp|max:2048', 
        ]);

        try {
            $brand = Brand::create(['brand_name' => $validated['brand_name']]);

            if ($request->hasFile('logo')) {
                // Spatie MediaLibrary handles the polymorphic attachment to 'brand_logos' collection[cite: 1]
                $brand->addMediaFromRequest('logo')->toMediaCollection('brand_logos');
            }

            return redirect()->route('admin.brands.index')
                ->with('success', 'Manufacturer brand added successfully.');
                
        } catch (\Exception $e) {
            // Logging for XAMPP local debugging
            Log::error('Failed to store brand: ' . $e->getMessage());
            return back()->withInput()->with('error', 'Failed to save brand. Ensure your XAMPP temp folder is writable.');
        }
    }

    /**
     * Show the form for editing the specified brand.
     */
    public function edit(Brand $brand): View
    {
        return view('admin.brands.edit', compact('brand'));
    }

    /**
     * Update the specified brand in storage.
     */
    public function update(Request $request, Brand $brand): RedirectResponse
    {
        $validated = $request->validate([
            'brand_name' => 'required|string|max:100|unique:brands,brand_name,' . $brand->id,
            'logo'       => 'nullable|image|mimes:jpeg,png,jpg,svg,webp|max:2048',
        ]);

        try {
            $brand->update(['brand_name' => $validated['brand_name']]);

            // If a new logo is uploaded, replace the old one
            if ($request->hasFile('logo')) {
                $brand->clearMediaCollection('brand_logos'); 
                $brand->addMediaFromRequest('logo')->toMediaCollection('brand_logos');
            }

            return redirect()->route('admin.brands.index')
                ->with('success', 'Brand updated successfully.');

        } catch (\Exception $e) {
            Log::error('Failed to update brand: ' . $e->getMessage());
            return back()->withInput()->with('error', 'Failed to update brand metadata.');
        }
    }

    /**
     * Remove the specified brand from storage.
     */
    public function destroy(Brand $brand): RedirectResponse
    {
        // Protected Deletion logic: Only delete if no cars are associated to maintain financial integrity.
        if ($brand->cars()->count() > 0) {
            return back()->with('error', 'Cannot delete brand. There are vehicles currently associated with it.');
        }

        $brand->delete();

        return redirect()->route('admin.brands.index')
            ->with('success', 'Brand removed from directory.');
    }
}