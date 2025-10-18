@extends('layouts.app')

@section('content')
<div class="py-12" x-data="{ showPdfModal: false }">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <!-- Page Header -->
        <div class="mb-8 bg-gradient-to-r from-blue-50 to-blue-100 dark:from-blue-900 dark:to-blue-800 rounded-lg p-6">
            <div class="flex justify-between items-center">
                <div>
                    <h1 class="text-3xl font-bold text-blue-900 dark:text-blue-100">
                        Citizen Management
                    </h1>
                    <p class="text-blue-700 dark:text-blue-300 mt-2 font-medium">
                        Manage and view all registered citizens of Barangay 50
                    </p>
                </div>
                <a href="{{ route('citizens.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-6 rounded-lg transition duration-200">
                    + Add New Citizen
                </a>
            </div>
        </div>

        @if ($message = Session::get('success'))
            <div class="mb-6 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg">
                {{ $message }}
            </div>
        @endif

        <!-- Filters Card -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6 mb-6">
            <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Filters & Search</h2>
            
            <form method="GET" action="{{ route('citizens.index') }}" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                <!-- Search -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                        Search (Name, Email, Phone)
                    </label>
                    <input 
                        type="text" 
                        name="search" 
                        placeholder="Enter search term" 
                        value="{{ request('search') }}"
                        class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg dark:bg-gray-700 dark:text-white"
                    >
                </div>

                <!-- Gender Filter -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                        Gender
                    </label>
                    <select name="gender" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg dark:bg-gray-700 dark:text-white">
                        <option value="all">All Genders</option>
                        <option value="Male" {{ request('gender') == 'Male' ? 'selected' : '' }}>Male</option>
                        <option value="Female" {{ request('gender') == 'Female' ? 'selected' : '' }}>Female</option>
                        <option value="Other" {{ request('gender') == 'Other' ? 'selected' : '' }}>Other</option>
                    </select>
                </div>

                <!-- Civil Status Filter -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                        Civil Status
                    </label>
                    <select name="civil_status" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg dark:bg-gray-700 dark:text-white">
                        <option value="all">All Status</option>
                        <option value="Single" {{ request('civil_status') == 'Single' ? 'selected' : '' }}>Single</option>
                        <option value="Married" {{ request('civil_status') == 'Married' ? 'selected' : '' }}>Married</option>
                        <option value="Divorced" {{ request('civil_status') == 'Divorced' ? 'selected' : '' }}>Divorced</option>
                        <option value="Widowed" {{ request('civil_status') == 'Widowed' ? 'selected' : '' }}>Widowed</option>
                    </select>
                </div>

                <!-- Age Group Filter -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                        Age Group
                    </label>
                    <select name="age_group" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg dark:bg-gray-700 dark:text-white">
                        <option value="all">All Ages</option>
                        <option value="children" {{ request('age_group') == 'children' ? 'selected' : '' }}>Children (0-12)</option>
                        <option value="youth" {{ request('age_group') == 'youth' ? 'selected' : '' }}>Youth (13-24)</option>
                        <option value="adult" {{ request('age_group') == 'adult' ? 'selected' : '' }}>Adult (25-59)</option>
                        <option value="senior" {{ request('age_group') == 'senior' ? 'selected' : '' }}>Senior (60+)</option>
                    </select>
                </div>

                <!-- Category Filter -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                        Category
                    </label>
                    <select name="category_id" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg dark:bg-gray-700 dark:text-white">
                        <option value="all">All Categories</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->icon ?? '📁' }} {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Filter Buttons -->
                <div class="col-span-1 md:col-span-2 lg:col-span-4 flex gap-3 flex-wrap">
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-6 rounded-lg transition duration-200">
                        Apply Filters
                    </button>
                    <a href="{{ route('citizens.index') }}" class="bg-gray-400 hover:bg-gray-500 text-white font-semibold py-2 px-6 rounded-lg transition duration-200">
                        Clear Filters
                    </a>
                    <button type="button" @click.prevent="showPdfModal = true" class="bg-red-600 hover:bg-red-700 text-white font-semibold py-2 px-6 rounded-lg transition duration-200 flex items-center gap-2">
                        📄 Download as PDF
                    </button>
                </div>
            </form>
        </div>

        <!-- PDF Export Options Modal -->
        <div x-show="showPdfModal" @keydown.escape="showPdfModal = false" class="fixed inset-0 z-50 overflow-y-auto" style="display: none;">
            <!-- Backdrop -->
            <div x-show="showPdfModal" @click="showPdfModal = false" class="fixed inset-0 bg-black bg-opacity-50 transition-opacity"></div>

            <!-- Modal -->
            <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
                <div x-show="showPdfModal" class="relative inline-block align-bottom bg-white dark:bg-gray-800 rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:w-full sm:max-w-md">
                    <div class="bg-white dark:bg-gray-800 px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-4">
                            📋 Choose PDF Report Options
                        </h3>
                        
                        <form id="pdfOptionsForm" method="GET" action="{{ route('citizens.export-pdf', request()->query()) }}" target="_blank">
                            <div class="space-y-3">
                                <!-- Always include -->
                                <p class="text-sm text-gray-600 dark:text-gray-400 mb-3">Select information to include in the report:</p>
                                
                                <!-- Name (always included) -->
                                <div class="flex items-center">
                                    <input type="checkbox" name="include_name" value="1" checked disabled class="w-4 h-4 text-blue-600 rounded cursor-not-allowed opacity-50">
                                    <label class="ml-3 text-sm text-gray-700 dark:text-gray-300 cursor-not-allowed opacity-50">
                                        Name & Address <span class="text-gray-500">(always included)</span>
                                    </label>
                                </div>

                                <!-- Gender -->
                                <div class="flex items-center">
                                    <input type="checkbox" name="include_gender" value="1" checked class="w-4 h-4 text-blue-600 rounded cursor-pointer">
                                    <label class="ml-3 text-sm text-gray-700 dark:text-gray-300 cursor-pointer">
                                        Gender
                                    </label>
                                </div>

                                <!-- Age -->
                                <div class="flex items-center">
                                    <input type="checkbox" name="include_age" value="1" checked class="w-4 h-4 text-blue-600 rounded cursor-pointer">
                                    <label class="ml-3 text-sm text-gray-700 dark:text-gray-300 cursor-pointer">
                                        Age
                                    </label>
                                </div>

                                <!-- Birthdate -->
                                <div class="flex items-center">
                                    <input type="checkbox" name="include_birthdate" value="1" class="w-4 h-4 text-blue-600 rounded cursor-pointer">
                                    <label class="ml-3 text-sm text-gray-700 dark:text-gray-300 cursor-pointer">
                                        Birthdate
                                    </label>
                                </div>

                                <!-- Civil Status -->
                                <div class="flex items-center">
                                    <input type="checkbox" name="include_civil_status" value="1" checked class="w-4 h-4 text-blue-600 rounded cursor-pointer">
                                    <label class="ml-3 text-sm text-gray-700 dark:text-gray-300 cursor-pointer">
                                        Civil Status
                                    </label>
                                </div>

                                <!-- Contact Info -->
                                <div class="flex items-center">
                                    <input type="checkbox" name="include_contact" value="1" checked class="w-4 h-4 text-blue-600 rounded cursor-pointer">
                                    <label class="ml-3 text-sm text-gray-700 dark:text-gray-300 cursor-pointer">
                                        Contact (Email, Phone)
                                    </label>
                                </div>

                                <!-- PhilSys Card Number -->
                                <div class="flex items-center">
                                    <input type="checkbox" name="include_pcn" value="1" checked class="w-4 h-4 text-blue-600 rounded cursor-pointer">
                                    <label class="ml-3 text-sm text-gray-700 dark:text-gray-300 cursor-pointer">
                                        PhilSys Card Number
                                    </label>
                                </div>

                                <!-- Occupation -->
                                <div class="flex items-center">
                                    <input type="checkbox" name="include_occupation" value="1" class="w-4 h-4 text-blue-600 rounded cursor-pointer">
                                    <label class="ml-3 text-sm text-gray-700 dark:text-gray-300 cursor-pointer">
                                        Occupation
                                    </label>
                                </div>

                                <!-- Status -->
                                <div class="flex items-center">
                                    <input type="checkbox" name="include_status" value="1" class="w-4 h-4 text-blue-600 rounded cursor-pointer">
                                    <label class="ml-3 text-sm text-gray-700 dark:text-gray-300 cursor-pointer">
                                        Citizen Status
                                    </label>
                                </div>

                                <!-- Categories -->
                                <div class="flex items-center">
                                    <input type="checkbox" name="include_categories" value="1" checked class="w-4 h-4 text-blue-600 rounded cursor-pointer">
                                    <label class="ml-3 text-sm text-gray-700 dark:text-gray-300 cursor-pointer">
                                        Categories
                                    </label>
                                </div>
                            </div>

                            <!-- Buttons -->
                            <div class="mt-6 flex gap-3">
                                <button type="submit" class="flex-1 bg-red-600 hover:bg-red-700 text-white font-semibold py-2 px-4 rounded-lg transition duration-200">
                                    Download PDF
                                </button>
                                <button type="button" @click="showPdfModal = false" class="flex-1 bg-gray-400 hover:bg-gray-500 text-white font-semibold py-2 px-4 rounded-lg transition duration-200">
                                    Cancel
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Citizens Table -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden">
            @if ($citizens->count() > 0)
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gray-100 dark:bg-gray-700 border-b border-gray-200 dark:border-gray-600">
                            <tr>
                                <th class="px-6 py-3 text-left text-sm font-semibold text-gray-900 dark:text-white">Name</th>
                                <th class="px-6 py-3 text-left text-sm font-semibold text-gray-900 dark:text-white">Age</th>
                                <th class="px-6 py-3 text-left text-sm font-semibold text-gray-900 dark:text-white">Gender</th>
                                <th class="px-6 py-3 text-left text-sm font-semibold text-gray-900 dark:text-white">Contact</th>
                                <th class="px-6 py-3 text-left text-sm font-semibold text-gray-900 dark:text-white">Categories</th>
                                <th class="px-6 py-3 text-left text-sm font-semibold text-gray-900 dark:text-white">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 dark:divide-gray-600">
                            @forelse ($citizens as $citizen)
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                                    <td class="px-6 py-4">
                                        <div class="font-semibold text-gray-900 dark:text-white">
                                            {{ $citizen->full_name }}
                                        </div>
                                        <div class="text-sm text-gray-500 dark:text-gray-400">
                                            {{ $citizen->address }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-gray-900 dark:text-white">
                                        {{ $citizen->age ?? 'N/A' }}
                                    </td>
                                    <td class="px-6 py-4 text-gray-900 dark:text-white">
                                        {{ $citizen->gender ?? 'Not specified' }}
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-900 dark:text-white">
                                        @if ($citizen->email)
                                            <div>{{ $citizen->email }}</div>
                                        @endif
                                        @if ($citizen->phone)
                                            <div>{{ $citizen->phone }}</div>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 text-sm">
                                        <div class="flex flex-wrap gap-1">
                                            @forelse ($citizen->categories as $category)
                                                <span class="px-3 py-1 rounded-full text-xs font-semibold text-white" style="background-color: {{ $category->color }}">
                                                    {{ $category->icon ?? '' }} {{ $category->name }}
                                                </span>
                                            @empty
                                                <span class="text-gray-500 dark:text-gray-400 text-xs">No categories</span>
                                            @endforelse
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-sm font-semibold">
                                        <a href="{{ route('citizens.show', $citizen) }}" class="text-blue-600 hover:text-blue-900 dark:text-blue-400 dark:hover:text-blue-300 mr-3">
                                            View
                                        </a>
                                        <a href="{{ route('citizens.edit', $citizen) }}" class="text-green-600 hover:text-green-900 dark:text-green-400 dark:hover:text-green-300 mr-3">
                                            Edit
                                        </a>
                                        <form method="POST" action="{{ route('citizens.destroy', $citizen) }}" class="inline" onsubmit="return confirm('Are you sure?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-300">
                                                Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-4 text-center text-gray-500 dark:text-gray-400">
                                        No citizens found. <a href="{{ route('citizens.create') }}" class="text-blue-600 hover:underline">Add one now</a>.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="px-6 py-4">
                    {{ $citizens->links() }}
                </div>
            @else
                <div class="px-6 py-12 text-center">
                    <p class="text-gray-600 dark:text-gray-400 mb-4">
                        No citizens registered yet.
                    </p>
                    <a href="{{ route('citizens.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-6 rounded-lg transition duration-200 inline-block">
                        Add First Citizen
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
