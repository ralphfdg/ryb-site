<x-app-layout>
    <div class="flex h-screen bg-gray-900 text-white">
        
        <aside class="w-64 bg-gray-800 border-r border-gray-700 bg-opacity-50 backdrop-blur-md">
            <div class="p-6">
                <h2 class="text-2xl font-bold text-blue-400">RYB Admin</h2>
            </div>
            <nav class="mt-6">
                <a href="#" class="block px-6 py-3 bg-gray-700 bg-opacity-50 border-l-4 border-blue-500 text-blue-300">Dashboard</a>
                <a href="#" class="block px-6 py-3 hover:bg-gray-700 hover:text-blue-300 transition">Inventory</a>
                <a href="#" class="block px-6 py-3 hover:bg-gray-700 hover:text-blue-300 transition">Sales</a>
                <a href="#" class="block px-6 py-3 hover:bg-gray-700 hover:text-blue-300 transition">Customers</a>
                <a href="#" class="block px-6 py-3 hover:bg-gray-700 hover:text-blue-300 transition">Inquiries</a>
            </nav>
        </aside>

        <main class="flex-1 p-8 overflow-y-auto">
            <h1 class="text-3xl font-semibold mb-8">Dashboard Overview</h1>
            
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                <div class="p-6 bg-white bg-opacity-10 backdrop-filter backdrop-blur-lg rounded-xl border border-gray-600 shadow-lg">
                    <h3 class="text-gray-400 text-sm font-medium">Total Cars</h3>
                    <p class="text-3xl font-bold mt-2">156</p>
                </div>
                <div class="p-6 bg-white bg-opacity-10 backdrop-filter backdrop-blur-lg rounded-xl border border-gray-600 shadow-lg">
                    <h3 class="text-gray-400 text-sm font-medium">Available Cars</h3>
                    <p class="text-3xl font-bold mt-2">124</p>
                </div>
                <div class="p-6 bg-white bg-opacity-10 backdrop-filter backdrop-blur-lg rounded-xl border border-gray-600 shadow-lg">
                    <h3 class="text-gray-400 text-sm font-medium">Sold Cars</h3>
                    <p class="text-3xl font-bold mt-2">32</p>
                </div>
                <div class="p-6 bg-white bg-opacity-10 backdrop-filter backdrop-blur-lg rounded-xl border border-gray-600 shadow-lg">
                    <h3 class="text-gray-400 text-sm font-medium">Total Customers</h3>
                    <p class="text-3xl font-bold mt-2">487</p>
                </div>
            </div>
        </main>

    </div>
</x-app-layout>