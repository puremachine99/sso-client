@extends('layouts.app')

@section('content')
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <!-- Hero Section -->
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100">
            <!-- Profile Header -->
            <div class="bg-gradient-to-r from-indigo-500 to-purple-600 p-6 sm:p-8 text-white">
                <div class="flex flex-col sm:flex-row items-center gap-6">
                    <div class="relative">
                        <div
                            class="w-24 h-24 rounded-full bg-white/20 backdrop-blur-sm flex items-center justify-center border-2 border-white/30">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>
                    </div>

                    <div class="text-center sm:text-left">
                        @if (isset($user))
                            <h1 class="text-2xl sm:text-3xl font-bold">{{ $user['name'] ?? 'John Doe' }}</h1>
                            <p class="text-indigo-100 mt-1">{{ $user['email'] ?? 'john.doe@example.com' }}</p>
                        @else
                            <h1 class="text-2xl sm:text-3xl font-bold">Guest User</h1>
                            <p class="text-indigo-100 mt-1">guest@example.com</p>
                        @endif

                        <div class="mt-3 flex flex-wrap justify-center sm:justify-start gap-2">
                            @if (isset($user['linked_accounts']))
                                @php
                                    $currentApp = collect($user['linked_accounts'])->firstWhere('app', 'umkm-client');
                                @endphp
                                @if ($currentApp)
                                    <span
                                        class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-white/20 backdrop-blur-sm">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 mr-1" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                        </svg>
                                        {{ $currentApp['app'] }} • {{ $currentApp['role'] ?? 'User' }}
                                    </span>
                                @endif
                            @else
                                <span
                                    class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-white/20 backdrop-blur-sm">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 mr-1" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                    </svg>
                                    Not logged in
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Account Details -->
            <div class="p-6 sm:p-8">
                @if (isset($user))
                    <!-- User is logged in -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Personal Info Card -->
                        <div class="bg-gray-50 rounded-lg p-5 border border-gray-200">
                            <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-indigo-500" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                                Personal Information
                            </h3>
                            <div class="space-y-3">
                                <div>
                                    <p class="text-sm text-gray-500">Full Name</p>
                                    <p class="font-medium">{{ $user['name'] }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Email</p>
                                    <p class="font-medium">{{ $user['email'] }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Account Created</p>
                                    <p class="font-medium">{{ $user['created_at'] ?? 'January 1, 2023' }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Linked Accounts Card -->
                        <div class="bg-gray-50 rounded-lg p-5 border border-gray-200">
                            <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-indigo-500" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                </svg>
                                Linked Accounts
                            </h3>
                            <div class="space-y-3">
                                @if (isset($user['linked_accounts']) && count($user['linked_accounts']) > 0)
                                    @foreach ($user['linked_accounts'] as $account)
                                        <div
                                            class="flex items-center justify-between py-2 border-b border-gray-200 last:border-0">
                                            <div class="flex items-center">
                                                <div class="bg-indigo-100 p-2 rounded-lg mr-3">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-indigo-600"
                                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                                    </svg>
                                                </div>
                                                <div>
                                                    <p class="font-medium">{{ $account['app'] }}</p>
                                                    <p class="text-sm text-gray-500">Role: {{ $account['role'] ?? 'User' }}
                                                    </p>
                                                </div>
                                            </div>
                                            <span
                                                class="text-xs px-2 py-1 rounded-full bg-green-100 text-green-800">Connected</span>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="text-center py-4">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 mx-auto text-gray-400"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        <p class="mt-2 text-gray-500">No linked accounts found</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="mt-8 flex flex-col sm:flex-row gap-4 justify-center">
                        <a href="/admin" class="btn-primary flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                            </svg>
                            Dashboard
                        </a>

                        <form method="POST" action="{{ route('logout.client') }}" class="flex">
                            @csrf
                            <button type="submit" class="btn-danger flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                </svg>
                                Logout
                            </button>
                        </form>

                        <a href="/logout-all" class="btn-secondary flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4" />
                            </svg>
                            Logout All
                        </a>
                    </div>
                @else
                    <!-- Guest view -->
                    <div class="text-center py-10">
                        <div class="mx-auto w-24 h-24 bg-indigo-100 rounded-full flex items-center justify-center mb-6">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-indigo-600" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                            </svg>
                        </div>
                        <h2 class="text-2xl font-bold text-gray-800 mb-2">You're not logged in</h2>
                        <p class="text-gray-600 mb-6 max-w-md mx-auto">Sign in to access your personalized dashboard and
                            account settings.</p>

                        <div class="flex flex-col sm:flex-row gap-4 justify-center">
                            <!-- SmartID Login Button - Google Style -->
                            <a href="{{ route('login.smartid') }}"
                                class="relative flex items-center justify-center w-full sm:w-auto px-6 py-3 border border-gray-300 rounded-lg shadow-sm bg-white text-gray-700 hover:bg-gray-50 transition-colors duration-200 group">
                                <span class="absolute left-4 flex items-center justify-center">
                                    <div class="bg-indigo-100 p-1.5 rounded-full">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-indigo-600"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                                        </svg>
                                    </div>
                                </span>
                                <span
                                    class="text-sm font-medium text-gray-700 group-hover:text-gray-900 transition-colors duration-200 ml-8">
                                    Continue with SmartID
                                </span>
                            </a>

                            <!-- Create Account Button - Secondary Style -->
                            <a href="http://smartidportal.test"
                                class="relative flex items-center justify-center w-full sm:w-auto px-6 py-3 border border-transparent rounded-lg shadow-sm bg-gray-100 text-gray-700 hover:bg-gray-200 transition-colors duration-200 group">
                                <span class="absolute left-4 flex items-center justify-center">
                                    <div class="bg-white p-1.5 rounded-full">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-600"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9" />
                                        </svg>
                                    </div>
                                </span>
                                <span
                                    class="text-sm font-medium text-gray-700 group-hover:text-gray-900 transition-colors duration-200 ml-8">
                                    Ke Portal
                                </span>
                            </a>
                        </div>
                    </div>
                @endif
            </div>
        </div>

        @if (session('error'))
            <div class="mt-6 bg-red-50 border-l-4 border-red-500 p-4">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-red-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm text-red-700">{{ session('error') }}</p>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection
