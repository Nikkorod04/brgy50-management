@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
        <!-- Page Header -->
        <div class="mb-8 bg-gradient-to-r from-green-50 to-green-100 dark:from-green-900 dark:to-green-800 rounded-lg p-6 flex justify-between items-center">
            <div>
                <h1 class="text-3xl font-bold text-green-900 dark:text-green-100">
                    {{ $citizen->full_name }}
                </h1>
                <p class="text-green-700 dark:text-green-300 mt-2 font-medium">
                    Citizen Record - Barangay 50, Tacloban City
                </p>
            </div>
            <div class="flex gap-3">
                <a href="{{ route('citizens.edit', $citizen) }}" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-6 rounded-lg transition duration-200">
                    ✎ Edit
                </a>
                <a href="{{ route('citizens.index') }}" class="bg-gray-400 hover:bg-gray-500 text-white font-semibold py-2 px-6 rounded-lg transition duration-200">
                    Back
                </a>
            </div>
        </div>

        @if ($message = Session::get('success'))
            <div class="mb-6 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg">
                {{ $message }}
            </div>
        @endif

        <!-- Main Details Card -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-8 mb-6">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Personal Information -->
                <div>
                    <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-4 pb-2 border-b border-gray-200 dark:border-gray-700">
                        Personal Information
                    </h2>
                    <dl class="space-y-3">
                        <div>
                            <dt class="text-sm font-medium text-gray-600 dark:text-gray-400">Full Name</dt>
                            <dd class="text-gray-900 dark:text-white">{{ $citizen->full_name }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-600 dark:text-gray-400">Birthdate</dt>
                            <dd class="text-gray-900 dark:text-white">{{ $citizen->birthdate->format('F d, Y') }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-600 dark:text-gray-400">Age</dt>
                            <dd class="text-gray-900 dark:text-white">{{ $citizen->age }} years old</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-600 dark:text-gray-400">Gender</dt>
                            <dd class="text-gray-900 dark:text-white">{{ $citizen->gender ?? 'Not specified' }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-600 dark:text-gray-400">Civil Status</dt>
                            <dd class="text-gray-900 dark:text-white">{{ $citizen->civil_status ?? 'Not specified' }}</dd>
                        </div>
                    </dl>
                </div>

                <!-- Contact Information -->
                <div>
                    <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-4 pb-2 border-b border-gray-200 dark:border-gray-700">
                        Contact Information
                    </h2>
                    <dl class="space-y-3">
                        <div>
                            <dt class="text-sm font-medium text-gray-600 dark:text-gray-400">Email</dt>
                            <dd class="text-gray-900 dark:text-white">
                                @if ($citizen->email)
                                    <a href="mailto:{{ $citizen->email }}" class="text-blue-600 hover:underline">{{ $citizen->email }}</a>
                                @else
                                    <span class="text-gray-500">Not provided</span>
                                @endif
                            </dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-600 dark:text-gray-400">Phone</dt>
                            <dd class="text-gray-900 dark:text-white">
                                @if ($citizen->phone)
                                    <a href="tel:{{ $citizen->phone }}" class="text-blue-600 hover:underline">{{ $citizen->phone }}</a>
                                @else
                                    <span class="text-gray-500">Not provided</span>
                                @endif
                            </dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-600 dark:text-gray-400">Address</dt>
                            <dd class="text-gray-900 dark:text-white">{{ $citizen->address }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-600 dark:text-gray-400">Location</dt>
                            <dd class="text-gray-900 dark:text-white">
                                {{ $citizen->city }}, {{ $citizen->province }} {{ $citizen->postal_code }}
                            </dd>
                        </div>
                    </dl>
                </div>

                <!-- Additional Information -->
                <div>
                    <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-4 pb-2 border-b border-gray-200 dark:border-gray-700">
                        Additional Information
                    </h2>
                    <dl class="space-y-3">
                        <div>
                            <dt class="text-sm font-medium text-gray-600 dark:text-gray-400">Occupation</dt>
                            <dd class="text-gray-900 dark:text-white">{{ $citizen->occupation ?? 'Not specified' }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-600 dark:text-gray-400">Education</dt>
                            <dd class="text-gray-900 dark:text-white">{{ $citizen->educational_attainment ?? 'Not specified' }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-600 dark:text-gray-400">Status</dt>
                            <dd class="text-gray-900 dark:text-white">
                                <span class="px-3 py-1 rounded-full text-sm font-semibold
                                    @if ($citizen->status == 'active')
                                        bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200
                                    @elseif ($citizen->status == 'inactive')
                                        bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200
                                    @else
                                        bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-200
                                    @endif
                                ">
                                    {{ ucfirst($citizen->status) }}
                                </span>
                            </dd>
                        </div>
                    </dl>
                </div>
            </div>
        </div>

        <!-- Special Categories Card -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-8 mb-6">
            <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-4 pb-2 border-b border-gray-200 dark:border-gray-700">
                Citizen Categories
            </h2>
            <div class="flex flex-wrap gap-3">
                @forelse ($citizen->categories as $category)
                    <span class="px-4 py-2 rounded-lg font-semibold text-white" style="background-color: {{ $category->color }}">
                        {{ $category->icon ?? '📁' }} {{ $category->name }}
                    </span>
                @empty
                    <p class="text-gray-500 dark:text-gray-400">No categories assigned</p>
                @endforelse
            </div>
        </div>

        <!-- Documents & Pictures Card -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-8 mb-6">
            <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-4 pb-2 border-b border-gray-200 dark:border-gray-700">
                Documents & Pictures
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- PhilSys Card Number -->
                <div>
                    <dt class="text-sm font-medium text-gray-600 dark:text-gray-400 mb-2">PhilSys Card Number</dt>
                    <dd class="text-gray-900 dark:text-white font-mono text-lg">
                        @if ($citizen->pcn)
                            {{ $citizen->pcn }}
                        @else
                            <span class="text-gray-500">Not provided</span>
                        @endif
                    </dd>
                </div>

                <!-- Profile Picture -->
                <div>
                    <dt class="text-sm font-medium text-gray-600 dark:text-gray-400 mb-2">Profile Picture (1x1)</dt>
                    @if ($citizen->profile_picture)
                        <div class="flex flex-col gap-3">
                            <img src="{{ asset('storage/' . $citizen->profile_picture) }}" alt="Profile Picture" class="w-32 h-32 object-cover rounded-lg border border-gray-300 dark:border-gray-600">
                            <a href="{{ route('citizens.download-profile-picture', $citizen) }}" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-lg transition duration-200 text-center text-sm">
                                ⬇️ Download Picture
                            </a>
                        </div>
                    @else
                        <div class="w-32 h-32 bg-gray-200 dark:bg-gray-700 rounded-lg flex items-center justify-center border border-gray-300 dark:border-gray-600">
                            <p class="text-gray-500 dark:text-gray-400 text-center text-sm">No picture</p>
                        </div>
                    @endif
                </div>

                <!-- National ID Photo -->
                <div>
                    <dt class="text-sm font-medium text-gray-600 dark:text-gray-400 mb-2">National ID Photo</dt>
                    @if ($citizen->national_id_photo)
                        <div class="flex flex-col gap-3">
                            <img src="{{ asset('storage/' . $citizen->national_id_photo) }}" alt="National ID" class="w-32 h-32 object-cover rounded-lg border border-gray-300 dark:border-gray-600">
                            <a href="{{ route('citizens.download-national-id', $citizen) }}" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-lg transition duration-200 text-center text-sm">
                                ⬇️ Download ID
                            </a>
                        </div>
                    @else
                        <div class="w-32 h-32 bg-gray-200 dark:bg-gray-700 rounded-lg flex items-center justify-center border border-gray-300 dark:border-gray-600">
                            <p class="text-gray-500 dark:text-gray-400 text-center text-sm">No ID photo</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Notes Section -->
        @if ($citizen->notes)
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-8 mb-6">
                <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-4 pb-2 border-b border-gray-200 dark:border-gray-700">
                    Notes
                </h2>
                <p class="text-gray-900 dark:text-white whitespace-pre-wrap">{{ $citizen->notes }}</p>
            </div>
        @endif

        <!-- Record Metadata -->
        <div class="bg-gray-100 dark:bg-gray-700 rounded-lg p-6">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 text-sm">
                <div>
                    <dt class="text-gray-600 dark:text-gray-400">Record ID</dt>
                    <dd class="text-gray-900 dark:text-white font-mono">{{ $citizen->id }}</dd>
                </div>
                <div>
                    <dt class="text-gray-600 dark:text-gray-400">Created By</dt>
                    <dd class="text-gray-900 dark:text-white">{{ $citizen->createdBy->name ?? 'Unknown' }}</dd>
                </div>
                <div>
                    <dt class="text-gray-600 dark:text-gray-400">Created At</dt>
                    <dd class="text-gray-900 dark:text-white">{{ $citizen->created_at->format('M d, Y H:i') }}</dd>
                </div>
                <div>
                    <dt class="text-gray-600 dark:text-gray-400">Last Updated</dt>
                    <dd class="text-gray-900 dark:text-white">{{ $citizen->updated_at->format('M d, Y H:i') }}</dd>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
