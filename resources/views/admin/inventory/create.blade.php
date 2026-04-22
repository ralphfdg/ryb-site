<x-app-layout>
    <div class="max-w-4xl mx-auto py-10 sm:px-6 lg:px-8">
        <div class="bg-slate-800/50 backdrop-blur-md border border-white/10 shadow-xl rounded-2xl p-8">
            <h2 class="text-2xl font-bold text-white mb-6">Add New Vehicle to Inventory</h2>

            <form action="{{ route('admin.inventory.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-300">Car Model</label>
                    <input type="text" name="model" class="mt-1 block w-full rounded-md bg-slate-700 border-gray-600 text-white" required>
                </div>

                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-300 mb-2">Upload Car Images</label>
                    <input type="file" name="images[]" multiple accept="image/*" class="block w-full text-sm text-gray-400 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:bg-yellow-500 file:text-slate-900 hover:file:bg-yellow-400">
                </div>

                <button type="submit" class="bg-yellow-500 hover:bg-yellow-400 text-slate-900 font-bold py-2 px-6 rounded-lg transition">
                    Save Vehicle Listing
                </button>
            </form>
        </div>
    </div>
</x-app-layout>