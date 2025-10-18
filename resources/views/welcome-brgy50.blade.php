<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Favicon -->
        <link rel="icon" type="image/png" href="{{ asset('brgy50-logo.png') }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

        <!-- Styles -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased dark:bg-black dark:text-white/50">
        <div class="bg-gradient-to-br from-blue-500 via-blue-600 to-blue-700 dark:from-slate-900 dark:via-slate-800 dark:to-slate-900 min-h-screen flex items-center justify-center px-4">
            <div class="w-full max-w-md">
                <!-- Header Section -->
                <div class="text-center mb-8">
                    <h1 class="text-4xl font-bold text-white mb-2">
                        Barangay 50
                    </h1>
                    <p class="text-xl text-blue-100 mb-1">
                        Management System
                    </p>
                    <p class="text-sm text-blue-200">
                        Tacloban City, Philippines
                    </p>
                </div>

                <!-- Login Card -->
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-2xl p-8">
                    <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-6 text-center">
                        Barangay Official Login
                    </h2>

                    <!-- Login Form -->
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <!-- Username -->
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Username
                            </label>
                            <input 
                                type="text" 
                                name="username" 
                                value="{{ old('username') }}"
                                class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg dark:bg-gray-700 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('username') border-red-500 @enderror"
                                placeholder="Enter your username"
                                required
                                autofocus
                            >
                            @error('username')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Password -->
                        <div class="mb-6">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Password
                            </label>
                            <input 
                                type="password" 
                                name="password"
                                class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg dark:bg-gray-700 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('password') border-red-500 @enderror"
                                placeholder="Enter your password"
                                required
                            >
                            @error('password')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Remember Me -->
                        <div class="mb-6">
                            <label class="flex items-center">
                                <input type="checkbox" name="remember" class="rounded border-gray-300 text-blue-600 shadow-sm focus:ring-blue-500 dark:bg-gray-700">
                                <span class="ml-2 text-sm text-gray-600 dark:text-gray-400">Remember me</span>
                            </label>
                        </div>

                        <!-- Login Button -->
                        <button 
                            type="submit"
                            class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-lg transition duration-200"
                        >
                            Login
                        </button>
                    </form>

                    <!-- Demo Credentials -->
                    <div class="mt-6 p-4 bg-blue-50 dark:bg-blue-900 rounded-lg">
                        <p class="text-sm text-gray-600 dark:text-gray-300 mb-2 font-semibold">Demo Credentials:</p>
                        <p class="text-sm text-gray-600 dark:text-gray-300">
                            <span class="font-mono bg-gray-200 dark:bg-gray-700 px-2 py-1 rounded">Username: brgy50</span>
                        </p>
                        <p class="text-sm text-gray-600 dark:text-gray-300">
                            <span class="font-mono bg-gray-200 dark:bg-gray-700 px-2 py-1 rounded">Password: brgy50</span>
                        </p>
                    </div>
                </div>

                <!-- Footer -->
                <div class="text-center text-sm text-blue-100 mt-8">
                    <p>{{ config('app.name') }} | Citizen Management and Demographics System</p>
                </div>
            </div>
        </div>
    </body>
</html>
