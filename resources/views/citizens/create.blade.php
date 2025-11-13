@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
        <!-- Page Header -->
        <div class="mb-8 bg-gradient-to-r from-indigo-50 to-indigo-100 dark:from-indigo-900 dark:to-indigo-800 rounded-lg p-6">
            <h1 class="text-3xl font-bold text-indigo-900 dark:text-indigo-100">
                @if (isset($citizen))
                    Edit Citizen Record
                @else
                    Add New Citizen
                @endif
            </h1>
            <p class="text-indigo-700 dark:text-indigo-300 mt-2 font-medium">
                Enter or update demographic information for a Barangay 50 citizen
            </p>
        </div>

        <!-- Form Card -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-8">
            <form method="POST" action="{{ isset($citizen) ? route('citizens.update', $citizen) : route('citizens.store') }}" enctype="multipart/form-data">
                @csrf
                @if (isset($citizen))
                    @method('PUT')
                @endif

                <!-- Personal Information Section -->
                <div class="mb-8">
                    <h2 class="text-xl font-semibold text-gray-900 dark:text-white mb-4 pb-2 border-b border-gray-200 dark:border-gray-700">
                        Personal Information
                    </h2>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <!-- First Name -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                First Name <span class="text-red-500">*</span>
                            </label>
                            <input 
                                type="text" 
                                name="first_name" 
                                value="{{ old('first_name', $citizen->first_name ?? '') }}"
                                class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg dark:bg-gray-700 dark:text-white @error('first_name') border-red-500 @enderror"
                                required
                            >
                            @error('first_name')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Middle Name -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                Middle Name
                            </label>
                            <input 
                                type="text" 
                                name="middle_name" 
                                value="{{ old('middle_name', $citizen->middle_name ?? '') }}"
                                class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg dark:bg-gray-700 dark:text-white"
                            >
                        </div>

                        <!-- Last Name -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                Last Name <span class="text-red-500">*</span>
                            </label>
                            <input 
                                type="text" 
                                name="last_name" 
                                value="{{ old('last_name', $citizen->last_name ?? '') }}"
                                class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg dark:bg-gray-700 dark:text-white @error('last_name') border-red-500 @enderror"
                                required
                            >
                            @error('last_name')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Suffix -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                Suffix (Jr., Sr., III, etc.)
                            </label>
                            <input 
                                type="text" 
                                name="suffix" 
                                value="{{ old('suffix', $citizen->suffix ?? '') }}"
                                class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg dark:bg-gray-700 dark:text-white"
                            >
                        </div>

                        <!-- Birthdate -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                Birthdate <span class="text-red-500">*</span>
                            </label>
                            <input 
                                type="date" 
                                name="birthdate" 
                                value="{{ old('birthdate', isset($citizen) && $citizen->birthdate ? $citizen->birthdate->format('Y-m-d') : '') }}"
                                class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg dark:bg-gray-700 dark:text-white @error('birthdate') border-red-500 @enderror"
                                required
                            >
                            @error('birthdate')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Gender -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                Gender
                            </label>
                            <select name="gender" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg dark:bg-gray-700 dark:text-white">
                                <option value="">Select Gender</option>
                                <option value="Male" {{ old('gender', $citizen->gender ?? '') == 'Male' ? 'selected' : '' }}>Male</option>
                                <option value="Female" {{ old('gender', $citizen->gender ?? '') == 'Female' ? 'selected' : '' }}>Female</option>
                                <option value="Other" {{ old('gender', $citizen->gender ?? '') == 'Other' ? 'selected' : '' }}>Other</option>
                                <option value="Prefer not to say" {{ old('gender', $citizen->gender ?? '') == 'Prefer not to say' ? 'selected' : '' }}>Prefer not to say</option>
                            </select>
                        </div>

                        <!-- Civil Status -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                Civil Status
                            </label>
                            <select name="civil_status" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg dark:bg-gray-700 dark:text-white">
                                <option value="">Select Status</option>
                                <option value="Single" {{ old('civil_status', $citizen->civil_status ?? '') == 'Single' ? 'selected' : '' }}>Single</option>
                                <option value="Married" {{ old('civil_status', $citizen->civil_status ?? '') == 'Married' ? 'selected' : '' }}>Married</option>
                                <option value="Divorced" {{ old('civil_status', $citizen->civil_status ?? '') == 'Divorced' ? 'selected' : '' }}>Divorced</option>
                                <option value="Widowed" {{ old('civil_status', $citizen->civil_status ?? '') == 'Widowed' ? 'selected' : '' }}>Widowed</option>
                                <option value="Separated" {{ old('civil_status', $citizen->civil_status ?? '') == 'Separated' ? 'selected' : '' }}>Separated</option>
                                <option value="Annulled" {{ old('civil_status', $citizen->civil_status ?? '') == 'Annulled' ? 'selected' : '' }}>Annulled</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Contact Information Section -->
                <div class="mb-8">
                    <h2 class="text-xl font-semibold text-gray-900 dark:text-white mb-4 pb-2 border-b border-gray-200 dark:border-gray-700">
                        Contact Information
                    </h2>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <!-- Email -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                Email
                            </label>
                            <input 
                                type="email" 
                                name="email" 
                                value="{{ old('email', $citizen->email ?? '') }}"
                                class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg dark:bg-gray-700 dark:text-white @error('email') border-red-500 @enderror"
                            >
                            @error('email')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Phone -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                Phone Number
                            </label>
                            <input 
                                type="tel" 
                                name="phone" 
                                value="{{ old('phone', $citizen->phone ?? '') }}"
                                class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg dark:bg-gray-700 dark:text-white"
                            >
                        </div>

                        <!-- Address -->
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                Address <span class="text-red-500">*</span>
                            </label>
                            <input 
                                type="text" 
                                name="address" 
                                value="{{ old('address', $citizen->address ?? '') }}"
                                class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg dark:bg-gray-700 dark:text-white @error('address') border-red-500 @enderror"
                                required
                            >
                            @error('address')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Barangay -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                Barangay <span class="text-red-500">*</span>
                            </label>
                            <input 
                                type="text" 
                                name="barangay" 
                                value="{{ old('barangay', $citizen->barangay ?? 'Barangay 50') }}"
                                class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg dark:bg-gray-700 dark:text-white bg-gray-100 dark:bg-gray-600 cursor-not-allowed"
                                required
                                disabled
                            >
                            <input type="hidden" name="barangay" value="{{ old('barangay', $citizen->barangay ?? 'Barangay 50') }}">
                        </div>

                        <!-- City -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                City <span class="text-red-500">*</span>
                            </label>
                            <input 
                                type="text" 
                                name="city" 
                                value="{{ old('city', $citizen->city ?? 'Tacloban City') }}"
                                class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg dark:bg-gray-700 dark:text-white bg-gray-100 dark:bg-gray-600 cursor-not-allowed"
                                required
                                disabled
                            >
                            <input type="hidden" name="city" value="{{ old('city', $citizen->city ?? 'Tacloban City') }}">
                        </div>

                        <!-- Province -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                Province <span class="text-red-500">*</span>
                            </label>
                            <input 
                                type="text" 
                                name="province" 
                                value="{{ old('province', $citizen->province ?? 'Leyte') }}"
                                class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg dark:bg-gray-700 dark:text-white bg-gray-100 dark:bg-gray-600 cursor-not-allowed"
                                required
                                disabled
                            >
                            <input type="hidden" name="province" value="{{ old('province', $citizen->province ?? 'Leyte') }}">
                        </div>

                        <!-- Postal Code -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                Postal Code
                            </label>
                            <input 
                                type="text" 
                                name="postal_code" 
                                value="{{ old('postal_code', $citizen->postal_code ?? '6500') }}"
                                class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg dark:bg-gray-700 dark:text-white bg-gray-100 dark:bg-gray-600 cursor-not-allowed"
                                disabled
                            >
                            <input type="hidden" name="postal_code" value="{{ old('postal_code', $citizen->postal_code ?? '6500') }}">
                        </div>
                    </div>
                </div>

                <!-- Additional Information Section -->
                <div class="mb-8">
                    <h2 class="text-xl font-semibold text-gray-900 dark:text-white mb-4 pb-2 border-b border-gray-200 dark:border-gray-700">
                        Additional Information
                    </h2>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <!-- Occupation -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                Occupation
                            </label>
                            <input 
                                type="text" 
                                name="occupation" 
                                value="{{ old('occupation', $citizen->occupation ?? '') }}"
                                class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg dark:bg-gray-700 dark:text-white"
                            >
                        </div>

                        <!-- Educational Attainment -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                Educational Attainment
                            </label>
                            <select 
                                name="educational_attainment" 
                                class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg dark:bg-gray-700 dark:text-white"
                            >
                                <option value="">Select Educational Attainment</option>
                                <option value="No Formal Education" {{ old('educational_attainment', $citizen->educational_attainment ?? '') == 'No Formal Education' ? 'selected' : '' }}>No Formal Education</option>
                                <option value="Elementary" {{ old('educational_attainment', $citizen->educational_attainment ?? '') == 'Elementary' ? 'selected' : '' }}>Elementary</option>
                                <option value="High School" {{ old('educational_attainment', $citizen->educational_attainment ?? '') == 'High School' ? 'selected' : '' }}>High School</option>
                                <option value="Vocational" {{ old('educational_attainment', $citizen->educational_attainment ?? '') == 'Vocational' ? 'selected' : '' }}>Vocational</option>
                                <option value="Bachelor's Degree" {{ old('educational_attainment', $citizen->educational_attainment ?? '') == "Bachelor's Degree" ? 'selected' : '' }}>Bachelor's Degree</option>
                                <option value="Master's Degree" {{ old('educational_attainment', $citizen->educational_attainment ?? '') == "Master's Degree" ? 'selected' : '' }}>Master's Degree</option>
                                <option value="Doctorate" {{ old('educational_attainment', $citizen->educational_attainment ?? '') == 'Doctorate' ? 'selected' : '' }}>Doctorate</option>
                            </select>
                        </div>

                        <!-- Notes -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                Notes
                            </label>
                            <textarea 
                                name="notes" 
                                rows="3"
                                class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg dark:bg-gray-700 dark:text-white"
                            >{{ old('notes', $citizen->notes ?? '') }}</textarea>
                        </div>
                    </div>
                </div>

                <!-- Special Categories Section -->
                <div class="mb-8">
                    <h2 class="text-xl font-semibold text-gray-900 dark:text-white mb-4 pb-2 border-b border-gray-200 dark:border-gray-700">
                        Categories & Documents
                    </h2>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                        <!-- Categories -->
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Citizen Categories
                            </label>
                            <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg max-h-40 overflow-y-auto border border-gray-300 dark:border-gray-600">
                                @forelse ($categories as $category)
                                    <label class="flex items-center mb-3 cursor-pointer">
                                        <input 
                                            type="checkbox" 
                                            name="categories[]" 
                                            value="{{ $category->id }}"
                                            @if(isset($selectedCategories) && in_array($category->id, $selectedCategories)) checked @endif
                                            class="rounded dark:bg-gray-600"
                                        >
                                        <span class="ml-3">
                                            <span class="text-sm font-medium text-gray-900 dark:text-white">{{ $category->icon ?? '📁' }} {{ $category->name }}</span>
                                        </span>
                                    </label>
                                @empty
                                    <p class="text-gray-500 dark:text-gray-400 text-sm">No categories available. <a href="{{ route('categories.create') }}" class="text-blue-600 hover:underline">Create one</a></p>
                                @endforelse
                            </div>
                            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Select all applicable categories for this citizen</p>
                        </div>

                        <!-- PhilSys Card Number -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                PhilSys Card Number
                            </label>
                            <input 
                                type="text" 
                                name="pcn" 
                                value="{{ old('pcn', $citizen->pcn ?? '') }}"
                                class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg dark:bg-gray-700 dark:text-white @error('pcn') border-red-500 @enderror"
                                placeholder="e.g., 1234-5678-9012-3456"
                            >
                            @error('pcn')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Profile Picture -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                Profile Picture (1x1)
                            </label>
                            <input 
                                type="file" 
                                name="profile_picture"
                                accept="image/*"
                                class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg dark:bg-gray-700 dark:text-white @error('profile_picture') border-red-500 @enderror"
                            >
                            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Max 2MB (JPEG, PNG, GIF)</p>
                            @error('profile_picture')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- National ID Photo -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                National ID Photo
                            </label>
                            <input 
                                type="file" 
                                name="national_id_photo"
                                accept="image/*"
                                class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg dark:bg-gray-700 dark:text-white @error('national_id_photo') border-red-500 @enderror"
                            >
                            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Max 2MB (JPEG, PNG, GIF)</p>
                            @error('national_id_photo')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                @if (isset($citizen))
                    <!-- Status Section (Edit Only) -->
                    <div class="mb-8">
                        <h2 class="text-xl font-semibold text-gray-900 dark:text-white mb-4 pb-2 border-b border-gray-200 dark:border-gray-700">
                            Record Status
                        </h2>

                        <select name="status" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg dark:bg-gray-700 dark:text-white">
                            <option value="active" {{ old('status', $citizen->status ?? 'active') == 'active' ? 'selected' : '' }}>Active</option>
                            <option value="inactive" {{ old('status', $citizen->status ?? 'active') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                            <option value="deceased" {{ old('status', $citizen->status ?? 'active') == 'deceased' ? 'selected' : '' }}>Deceased</option>
                        </select>
                    </div>
                @endif

                <!-- Form Buttons -->
                <div class="flex gap-4 pt-6 border-t border-gray-200 dark:border-gray-700">
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-8 rounded-lg transition duration-200">
                        @if (isset($citizen))
                            Update Record
                        @else
                            Add Citizen
                        @endif
                    </button>
                    <a href="{{ route('citizens.index') }}" class="bg-gray-400 hover:bg-gray-500 text-white font-semibold py-2 px-8 rounded-lg transition duration-200">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
