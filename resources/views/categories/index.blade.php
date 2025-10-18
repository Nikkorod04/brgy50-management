@extends('layouts.app')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-100 leading-tight">
        {{ __('Manage Categories') }}
    </h2>
@endsection

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <!-- Success Message -->
        @if (session('success'))
            <div class="mb-4 bg-green-50 dark:bg-green-900 border border-green-200 dark:border-green-700 text-green-800 dark:text-green-100 px-4 py-3 rounded">
                {{ session('success') }}
            </div>
        @endif

        <!-- Page Header -->
        <div class="mb-8 bg-gradient-to-r from-purple-50 to-purple-100 dark:from-purple-900 dark:to-purple-800 rounded-lg p-6 flex justify-between items-center">
            <div>
                <h1 class="text-3xl font-bold text-purple-900 dark:text-purple-100">
                    Citizen Categories
                </h1>
                <p class="text-purple-700 dark:text-purple-300 mt-2 font-medium">
                    Create and manage categories for organizing citizens (PWD, Senior, LGBTQ+, etc.)
                </p>
            </div>
            <a href="{{ route('categories.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-6 rounded-lg transition duration-200">
                + Add New Category
            </a>
        </div>

        <!-- Categories Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse ($categories as $category)
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6 border-l-4" style="border-left-color: {{ $category->color }}">
                    <div class="flex items-start justify-between mb-4">
                        <div>
                            <div class="text-3xl mb-2">{{ $category->icon ?? '📁' }}</div>
                            <h3 class="text-xl font-bold text-gray-900 dark:text-white">{{ $category->name }}</h3>
                            <p class="text-sm text-gray-600 dark:text-gray-400">{{ $category->slug }}</p>
                        </div>
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium {{ $category->is_active ? 'bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-100' : 'bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-100' }}">
                            {{ $category->is_active ? 'Active' : 'Inactive' }}
                        </span>
                    </div>

                    @if ($category->description)
                        <p class="text-gray-600 dark:text-gray-400 text-sm mb-4">{{ $category->description }}</p>
                    @endif

                    <div class="flex gap-2">
                        <a href="{{ route('categories.edit', $category) }}" class="flex-1 bg-blue-500 hover:bg-blue-600 text-white py-2 px-3 rounded text-center text-sm font-medium transition">
                            Edit
                        </a>
                        <form action="{{ route('categories.destroy', $category) }}" method="POST" class="flex-1">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Are you sure?')" class="w-full bg-red-500 hover:bg-red-600 text-white py-2 px-3 rounded text-sm font-medium transition">
                                Delete
                            </button>
                        </form>
                    </div>
                </div>
            @empty
                <div class="col-span-3 text-center py-12 bg-white dark:bg-gray-800 rounded-lg">
                    <p class="text-gray-600 dark:text-gray-400 mb-4">No categories yet.</p>
                    <a href="{{ route('categories.create') }}" class="text-blue-600 hover:text-blue-800 dark:text-blue-400 font-semibold">
                        Create the first category →
                    </a>
                </div>
            @endforelse
        </div>
    </div>
</div>
@endsection
