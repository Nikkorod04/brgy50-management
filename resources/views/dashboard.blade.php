@extends('layouts.app')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-100 leading-tight">
        {{ __('Dashboard') }} - Barangay 50 Mulopyo Management
    </h2>
@endsection

@section('content')
    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Header Section -->
            <div class="mb-8 bg-white dark:bg-gray-800 rounded-lg p-6 shadow-sm">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-4xl font-bold text-gray-900 dark:text-white">Dashboard</h1>
                        <p class="text-gray-900 dark:text-gray-200 mt-2 text-lg font-semibold">Welcome back, <span class="text-blue-600 dark:text-blue-400">{{ Auth::user()->name }}</span></p>
                    </div>
                    <div class="text-right">
                        <p class="text-gray-900 dark:text-gray-300 text-sm font-medium">Today: <span class="font-bold text-gray-900 dark:text-white">{{ now()->format('F d, Y') }}</span></p>
                    </div>
                </div>
            </div>

            <!-- Key Statistics Section -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-5 mb-8">
                <!-- Total Citizens Card -->
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm hover:shadow-md transition-shadow p-6 border-l-4 border-blue-600">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-500 dark:text-gray-400 text-xs font-semibold uppercase tracking-wide">Total Citizens</p>
                            <p class="text-4xl font-bold text-gray-900 dark:text-white mt-2">
                                {{ \App\Models\Citizen::active()->count() }}
                            </p>
                            <p class="text-xs text-gray-500 dark:text-gray-400 mt-2">Active records</p>
                        </div>
                        <div class="bg-blue-100 dark:bg-blue-900/30 rounded-lg p-4">
                            <img src="{{ asset('citizen.png') }}" alt="Citizens" class="w-8 h-8">
                        </div>
                    </div>
                </div>

                <!-- Gender Distribution Card -->
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm hover:shadow-md transition-shadow p-6 border-l-4 border-purple-600">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-500 dark:text-gray-400 text-xs font-semibold uppercase tracking-wide">Gender Distribution</p>
                            <div class="mt-2 space-y-1">
                                <p class="text-sm"><span class="font-bold text-blue-600">{{ \App\Models\Citizen::active()->byGender('Male')->count() }}</span> <span class="text-gray-600 dark:text-gray-400">Male</span></p>
                                <p class="text-sm"><span class="font-bold text-pink-600">{{ \App\Models\Citizen::active()->byGender('Female')->count() }}</span> <span class="text-gray-600 dark:text-gray-400">Female</span></p>
                                <p class="text-sm"><span class="font-bold text-green-600">{{ \App\Models\Citizen::active()->byGender('Other')->count() }}</span> <span class="text-gray-600 dark:text-gray-400">Other</span></p>
                            </div>
                        </div>
                        <div class="bg-purple-100 dark:bg-purple-900/30 rounded-lg p-4">
                            <img src="{{ asset('gender.png') }}" alt="Gender" class="w-8 h-8">
                        </div>
                    </div>
                </div>

                <!-- Categories Card -->
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm hover:shadow-md transition-shadow p-6 border-l-4 border-green-600">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-500 dark:text-gray-400 text-xs font-semibold uppercase tracking-wide">Categories</p>
                            <p class="text-4xl font-bold text-gray-900 dark:text-white mt-2">
                                {{ \App\Models\Category::where('is_active', true)->count() }}
                            </p>
                            <p class="text-xs text-gray-500 dark:text-gray-400 mt-2">Active categories</p>
                        </div>
                        <div class="bg-green-100 dark:bg-green-900/30 rounded-lg p-4">
                            <svg class="w-8 h-8 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- System Status Card -->
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm hover:shadow-md transition-shadow p-6 border-l-4 border-orange-600">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-500 dark:text-gray-400 text-xs font-semibold uppercase tracking-wide">System Status</p>
                            <div class="mt-2 flex items-center gap-2">
                                <span class="w-3 h-3 bg-green-500 rounded-full animate-pulse"></span>
                                <p class="font-semibold text-gray-900 dark:text-white">Operational</p>
                            </div>
                            <p class="text-xs text-gray-500 dark:text-gray-400 mt-2">All systems running</p>
                        </div>
                        <div class="bg-orange-100 dark:bg-orange-900/30 rounded-lg p-4">
                            <svg class="w-8 h-8 text-orange-600 dark:text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Categories Breakdown -->
            @php
                $categories = \App\Models\Category::where('is_active', true)->get();
            @endphp

            @if($categories->count() > 0)
                <div class="mb-8">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="h-1 w-12 bg-gray-800 dark:bg-gray-700 rounded-full"></div>
                        <h2 class="text-2xl font-bold dark:text-gray-800 dark:text-gray-300">Categories</h2>
                        <div class="flex-1 h-1 bg-gradient-to-r from-gray-800 to-transparent dark:from-gray-700 dark:to-transparent rounded-full"></div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
                        @foreach ($categories as $category)
                            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm hover:shadow-md transition-shadow p-6 border-t-4" style="border-color: {{ $category->color }};">
                                <div class="flex items-center justify-between mb-4">
                                    <h3 class="text-base font-semibold text-gray-900 dark:text-white">{{ $category->name }}</h3>
                                    <span class="text-2xl">{{ $category->icon ?? '📁' }}</span>
                                </div>
                                <div class="flex items-end justify-between">
                                    <div>
                                        <p class="text-xs text-gray-600 dark:text-gray-400 mb-1">Members</p>
                                        <p class="text-3xl font-bold text-gray-900 dark:text-white">
                                            {{ \App\Models\Citizen::active()->byCategory($category->id)->count() }}
                                        </p>
                                    </div>
                                    <a href="{{ route('citizens.index', ['category_id' => $category->id]) }}" class="text-sm font-medium hover:underline transition-colors text-gray-700 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white" style="border-bottom: 2px solid {{ $category->color }};">View →</a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- Quick Actions & Info Section -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-5">
                <!-- Quick Actions Card -->
                <div class="lg:col-span-2 bg-white dark:bg-gray-800 rounded-lg shadow-sm p-6">
                    <h2 class="text-lg font-bold text-gray-900 dark:text-white mb-4">Quick Actions</h2>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                        <a href="{{ route('citizens.index') }}" class="group relative overflow-hidden bg-gradient-to-br from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white font-semibold py-3 px-4 rounded-lg transition duration-200 flex items-center justify-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                            </svg>
                            View All Citizens
                        </a>
                        <a href="{{ route('citizens.create') }}" class="group relative overflow-hidden bg-gradient-to-br from-green-600 to-green-700 hover:from-green-700 hover:to-green-800 text-white font-semibold py-3 px-4 rounded-lg transition duration-200 flex items-center justify-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                            </svg>
                            Add New Citizen
                        </a>
                        <a href="{{ route('categories.index') }}" class="group relative overflow-hidden bg-gradient-to-br from-purple-600 to-purple-700 hover:from-purple-700 hover:to-purple-800 text-white font-semibold py-3 px-4 rounded-lg transition duration-200 flex items-center justify-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01"></path>
                            </svg>
                            Manage Categories
                        </a>
                        <a href="{{ route('citizens.export-pdf') }}" class="group relative overflow-hidden bg-gradient-to-br from-red-600 to-red-700 hover:from-red-700 hover:to-red-800 text-white font-semibold py-3 px-4 rounded-lg transition duration-200 flex items-center justify-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            Export Report
                        </a>
                    </div>
                </div>

                <!-- Information Card -->
                <div class="bg-blue-600 dark:bg-blue-700 border border-blue-700 dark:border-blue-600 rounded-lg p-6 text-white">
                    <div class="flex gap-3">
                        <svg class="w-6 h-6 text-white flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 5v8a2 2 0 01-2 2h-5l-5 4v-4H4a2 2 0 01-2-2V5a2 2 0 012-2h12a2 2 0 012 2zm-11-1a1 1 0 11-2 0 1 1 0 012 0z" clip-rule="evenodd"></path>
                        </svg>
                        <div>
                            <h3 class="font-semibold text-white mb-2">💡 Quick Tip</h3>
                            <p class="text-sm text-blue-100">
                                Use the export feature to generate professional PDF reports of your citizen data. Customize which columns to include for your needs.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
