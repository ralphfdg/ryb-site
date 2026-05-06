@extends('layouts.admin')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-white tracking-tight" style="font-family: 'Oswald', sans-serif;">Admin <span class="text-[#e52a2a]">Profile</span></h1>
        <p class="text-gray-500 mt-2 text-sm">Manage your administrative account details and security settings.</p>
    </div>

    @if (session('status') === 'profile-updated')
        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)"
             class="mb-6 p-4 bg-[#e52a2a]/10 border border-[#e52a2a]/20 rounded-lg flex items-center justify-between transition-all duration-300">
            <p class="text-[#e52a2a] text-sm font-bold">Profile updated successfully!</p>
        </div>
    @endif

    <div class="space-y-6">
        <div class="bg-[#0a0a0a] border border-[#1a1a1a] rounded-xl p-6 shadow-sm">
            <h2 class="text-lg font-bold text-white mb-6 border-b border-[#1a1a1a] pb-4">Personal Information</h2>

            <form method="post" action="{{ route('admin.profile.update') }}" class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @csrf
                @method('patch')

                <div class="col-span-2 md:col-span-1">
                    <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Full Name</label>
                    <input type="text" name="name" value="{{ old('name', $user->name) }}" required
                           class="w-full bg-[#050505] border border-[#1a1a1a] text-white rounded-lg focus:ring-1 focus:ring-[#e52a2a] focus:border-[#e52a2a] px-4 py-3 outline-none transition-colors">
                    @error('name') <span class="text-[#e52a2a] text-xs mt-2 block">{{ $message }}</span> @enderror
                </div>

                <div class="col-span-2 md:col-span-1">
                    <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Email Address</label>
                    <input type="email" name="email" value="{{ old('email', $user->email) }}" required
                           class="w-full bg-[#050505] border border-[#1a1a1a] text-white rounded-lg focus:ring-1 focus:ring-[#e52a2a] focus:border-[#e52a2a] px-4 py-3 outline-none transition-colors">
                    @error('email') <span class="text-[#e52a2a] text-xs mt-2 block">{{ $message }}</span> @enderror
                </div>

                <div class="col-span-2">
                    <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Phone Number</label>
                    <input type="text" name="phone_number" value="{{ old('phone_number', $user->phone_number) }}" required
                           class="w-full bg-[#050505] border border-[#1a1a1a] text-white rounded-lg focus:ring-1 focus:ring-[#e52a2a] focus:border-[#e52a2a] px-4 py-3 outline-none transition-colors">
                    @error('phone_number') <span class="text-[#e52a2a] text-xs mt-2 block">{{ $message }}</span> @enderror
                </div>

                <div class="col-span-2 flex justify-end mt-2">
                    <button type="submit" class="px-6 py-2.5 bg-[#e52a2a] text-white text-sm font-bold rounded-lg hover:bg-[#cc2222] transition-colors cursor-pointer">
                        Save Changes
                    </button>
                </div>
            </form>
        </div>

        <div class="bg-[#0a0a0a] border border-[#1a1a1a] rounded-xl p-6 shadow-sm">
            <h2 class="text-lg font-bold text-white mb-6 border-b border-[#1a1a1a] pb-4">Security Settings</h2>

            <form method="post" action="{{ route('password.update') }}" class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @csrf
                @method('put')

                <div class="col-span-2">
                    <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Current Password</label>
                    <input type="password" name="current_password" required
                           class="w-full bg-[#050505] border border-[#1a1a1a] text-white rounded-lg focus:ring-1 focus:ring-[#e52a2a] focus:border-[#e52a2a] px-4 py-3 outline-none transition-colors">
                    @error('current_password') <span class="text-[#e52a2a] text-xs mt-2 block">{{ $message }}</span> @enderror
                </div>

                <div class="col-span-2 md:col-span-1">
                    <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">New Password</label>
                    <input type="password" name="password" required
                           class="w-full bg-[#050505] border border-[#1a1a1a] text-white rounded-lg focus:ring-1 focus:ring-[#e52a2a] focus:border-[#e52a2a] px-4 py-3 outline-none transition-colors">
                    @error('password') <span class="text-[#e52a2a] text-xs mt-2 block">{{ $message }}</span> @enderror
                </div>

                <div class="col-span-2 md:col-span-1">
                    <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Confirm Password</label>
                    <input type="password" name="password_confirmation" required
                           class="w-full bg-[#050505] border border-[#1a1a1a] text-white rounded-lg focus:ring-1 focus:ring-[#e52a2a] focus:border-[#e52a2a] px-4 py-3 outline-none transition-colors">
                    @error('password_confirmation') <span class="text-[#e52a2a] text-xs mt-2 block">{{ $message }}</span> @enderror
                </div>

                <div class="col-span-2 flex justify-end mt-2">
                    <button type="submit" class="px-6 py-2.5 bg-transparent border border-[#333] text-white text-sm font-bold rounded-lg hover:bg-[#1a1a1a] hover:border-[#e52a2a] transition-colors cursor-pointer">
                        Update Password
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection