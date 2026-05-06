@extends('layouts.app')

@section('content')
    <div class="bg-ryb-darker min-h-screen pt-24 pb-12">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="mb-8">
                <h1 class="text-3xl font-bold text-white tracking-tight">Account <span class="text-ryb-red">Settings</span>
                </h1>
                <p class="text-ryb-light/60 mt-2">Manage your personal information and security preferences.</p>
            </div>

            <div class="space-y-8">
                {{-- Profile Information Card --}}
                <section
                    class="bg-ryb-dark border border-ryb-muted rounded-2xl p-8 shadow-2xl shadow-black/50 backdrop-blur-md">
                    <div class="flex items-center gap-4 mb-8 border-b border-ryb-muted pb-4">
                        <div class="p-3 bg-ryb-darker rounded-xl border border-ryb-muted">
                            <svg class="w-6 h-6 text-ryb-red" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>
                        <h2 class="text-xl font-bold text-white">Personal Information</h2>
                    </div>

                    {{-- Success Notification (Alpine.js makes it dismissible) --}}
                    @if (session('status') === 'profile-updated')
                        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)"
                            class="mb-6 p-4 bg-green-500/10 border border-green-500/50 rounded-lg flex items-center justify-between">
                            <p class="text-green-400 text-sm font-bold">Profile updated successfully!</p>
                        </div>
                    @endif

                    <form method="post" action="{{ route('dashboard.profile.update') }}"
                        class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        @csrf
                        @method('patch')

                        <div class="col-span-2 md:col-span-1">
                            <label class="block text-sm font-medium text-ryb-light/70 mb-2">Full Name</label>
                            <input type="text" name="name" value="{{ old('name', $user->name) }}" required
                                class="w-full bg-ryb-darker border border-ryb-muted text-ryb-light rounded-lg focus:ring-ryb-red focus:border-ryb-red px-4 py-3 outline-none transition">
                            {{-- Display Validation Errors --}}
                            @error('name')
                                <span class="text-ryb-red text-xs mt-2 block">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-span-2 md:col-span-1">
                            <label class="block text-sm font-medium text-ryb-light/70 mb-2">Email Address</label>
                            <input type="email" name="email" value="{{ old('email', $user->email) }}" required
                                class="w-full bg-ryb-darker border border-ryb-muted text-ryb-light rounded-lg focus:ring-ryb-red focus:border-ryb-red px-4 py-3 outline-none transition">
                            @error('email')
                                <span class="text-ryb-red text-xs mt-2 block">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-span-2">
                            <label class="block text-sm font-medium text-ryb-light/70 mb-2">Phone Number</label>
                            <input type="text" name="phone_number" value="{{ old('phone_number', $user->phone_number) }}"
                                required
                                class="w-full bg-ryb-darker border border-ryb-muted text-ryb-light rounded-lg focus:ring-ryb-red focus:border-ryb-red px-4 py-3 outline-none transition">
                            @error('phone_number')
                                <span class="text-ryb-red text-xs mt-2 block">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-span-2 flex justify-end mt-4">
                            <button type="submit"
                                class="px-8 py-3 bg-ryb-red text-white font-bold rounded-lg hover:bg-ryb-red-dark transition shadow-lg border border-ryb-red-dark cursor-pointer">
                                Save Changes
                            </button>
                        </div>
                    </form>
                </section>

                {{-- Security / Password Section remains as per previous requirements --}}
                <section class="bg-ryb-dark border border-ryb-muted rounded-2xl p-8 shadow-2xl shadow-black/50">
                    <div class="flex items-center gap-4 mb-8 border-b border-ryb-muted pb-4">
                        <div class="p-3 bg-ryb-darker rounded-xl border border-ryb-muted">
                            <svg class="w-6 h-6 text-ryb-red" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                            </svg>
                        </div>
                        <h2 class="text-xl font-bold text-white">Security</h2>
                    </div>

                    <form method="post" action="{{ route('password.update') }}" class="space-y-6">
                        @csrf
                        @method('put')
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="col-span-2">
                                <label class="block text-sm font-medium text-ryb-light/70 mb-2">Current Password</label>
                                <input type="password" name="current_password"
                                    class="w-full bg-ryb-darker border border-ryb-muted text-ryb-light rounded-lg focus:ring-ryb-red focus:border-ryb-red px-4 py-3 outline-none transition">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-ryb-light/70 mb-2">New Password</label>
                                <input type="password" name="password"
                                    class="w-full bg-ryb-darker border border-ryb-muted text-ryb-light rounded-lg focus:ring-ryb-red focus:border-ryb-red px-4 py-3 outline-none transition">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-ryb-light/70 mb-2">Confirm New Password</label>
                                <input type="password" name="password_confirmation"
                                    class="w-full bg-ryb-darker border border-ryb-muted text-ryb-light rounded-lg focus:ring-ryb-red focus:border-ryb-red px-4 py-3 outline-none transition">
                            </div>
                        </div>
                        <div class="flex justify-end mt-4">
                            <button type="submit"
                                class="px-8 py-3 border border-ryb-muted text-ryb-light font-semibold rounded-lg hover:bg-ryb-muted hover:text-white transition cursor-pointer">
                                Update Password
                            </button>
                        </div>
                    </form>
                </section>
            </div>
        </div>
    </div>
@endsection
