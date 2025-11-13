<?php

namespace App\Http\Controllers;

use App\Models\Citizen;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class CitizenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $query = Citizen::active();

        // Search functionality
        if ($request->filled('search')) {
            $query->search($request->search);
        }

        // Filter by gender
        if ($request->filled('gender') && $request->gender !== 'all') {
            $query->byGender($request->gender);
        }

        // Filter by civil status
        if ($request->filled('civil_status') && $request->civil_status !== 'all') {
            $query->byCivilStatus($request->civil_status);
        }

        // Filter by age group
        if ($request->filled('age_group') && $request->age_group !== 'all') {
            $query->byAgeGroup($request->age_group);
        }

        // Filter by category
        if ($request->filled('category_id') && $request->category_id !== 'all') {
            $query->byCategory($request->category_id);
        }

        $citizens = $query->with(['categories', 'createdBy'])
                          ->orderBy('last_name', 'asc')
                          ->paginate(15);

        $categories = Category::where('is_active', true)->get();

        return view('citizens.index', compact('citizens', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $categories = Category::where('is_active', true)->get();
        $selectedCategories = [];
        return view('citizens.create', compact('categories', 'selectedCategories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'last_name' => 'required|string|max:255',
            'suffix' => 'nullable|string|max:50',
            'email' => 'nullable|email|max:255|unique:citizens',
            'phone' => 'nullable|string|max:20',
            'address' => 'required|string',
            'barangay' => 'nullable|string',
            'city' => 'nullable|string',
            'province' => 'nullable|string',
            'postal_code' => 'nullable|string|max:10',
            'birthdate' => 'required|date|before:today',
            'gender' => 'nullable|in:Male,Female,Other,Prefer not to say',
            'civil_status' => 'nullable|in:Single,Married,Divorced,Widowed,Separated,Annulled',
            'occupation' => 'nullable|string|max:255',
            'educational_attainment' => 'nullable|string|max:255',
            'pcn' => 'nullable|string|max:255|unique:citizens',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'national_id_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'notes' => 'nullable|string',
            'categories' => 'nullable|array',
            'categories.*' => 'exists:categories,id',
        ]);

        // Set default values if not provided
        $validated['barangay'] = $validated['barangay'] ?? 'Barangay 50';
        $validated['city'] = $validated['city'] ?? 'Tacloban City';
        $validated['province'] = $validated['province'] ?? 'Leyte';

        // Handle profile picture upload
        if ($request->hasFile('profile_picture')) {
            $validated['profile_picture'] = $request->file('profile_picture')->store('citizens/profile-pictures', 'public');
        }

        // Handle national ID photo upload
        if ($request->hasFile('national_id_photo')) {
            $validated['national_id_photo'] = $request->file('national_id_photo')->store('citizens/national-ids', 'public');
        }

        // Calculate age from birthdate
        $birthdate = \Carbon\Carbon::parse($validated['birthdate']);
        $age = (int)$birthdate->diffInYears(now());
        // Ensure age is never negative
        $validated['age'] = max(0, $age);

        // Set created_by and updated_by
        $validated['created_by'] = auth()->id();
        $validated['updated_by'] = auth()->id();
        $validated['status'] = 'active';

        $citizen = Citizen::create($validated);

        // Attach categories
        if ($request->filled('categories')) {
            $citizen->categories()->attach($request->input('categories'));
        }

        return redirect()->route('citizens.index')
                       ->with('success', 'Citizen record created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Citizen $citizen): View
    {
        return view('citizens.show', compact('citizen'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Citizen $citizen): View
    {
        $categories = Category::where('is_active', true)->get();
        $selectedCategories = $citizen->categories->pluck('id')->toArray();
        return view('citizens.edit', compact('citizen', 'categories', 'selectedCategories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Citizen $citizen): RedirectResponse
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'last_name' => 'required|string|max:255',
            'suffix' => 'nullable|string|max:50',
            'email' => 'nullable|email|max:255|unique:citizens,email,' . $citizen->id,
            'phone' => 'nullable|string|max:20',
            'address' => 'required|string',
            'barangay' => 'required|string',
            'city' => 'required|string',
            'province' => 'required|string',
            'postal_code' => 'nullable|string|max:10',
            'birthdate' => 'required|date|before:today',
            'gender' => 'nullable|in:Male,Female,Other,Prefer not to say',
            'civil_status' => 'nullable|in:Single,Married,Divorced,Widowed,Separated,Annulled',
            'occupation' => 'nullable|string|max:255',
            'educational_attainment' => 'nullable|string|max:255',
            'pcn' => 'nullable|string|max:255|unique:citizens,pcn,' . $citizen->id,
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'national_id_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'notes' => 'nullable|string',
            'status' => 'in:active,inactive,deceased',
            'categories' => 'nullable|array',
            'categories.*' => 'exists:categories,id',
        ]);

        // Handle profile picture upload
        if ($request->hasFile('profile_picture')) {
            // Delete old picture if exists
            if ($citizen->profile_picture && \Storage::disk('public')->exists($citizen->profile_picture)) {
                \Storage::disk('public')->delete($citizen->profile_picture);
            }
            $validated['profile_picture'] = $request->file('profile_picture')->store('citizens/profile-pictures', 'public');
        }

        // Handle national ID photo upload
        if ($request->hasFile('national_id_photo')) {
            // Delete old photo if exists
            if ($citizen->national_id_photo && \Storage::disk('public')->exists($citizen->national_id_photo)) {
                \Storage::disk('public')->delete($citizen->national_id_photo);
            }
            $validated['national_id_photo'] = $request->file('national_id_photo')->store('citizens/national-ids', 'public');
        }

        // Calculate age from birthdate
        $birthdate = \Carbon\Carbon::parse($validated['birthdate']);
        $age = (int)$birthdate->diffInYears(now());
        // Ensure age is never negative
        $validated['age'] = max(0, $age);

        // Set updated_by
        $validated['updated_by'] = auth()->id();

        $citizen->update($validated);

        // Sync categories
        $citizen->categories()->sync($request->input('categories') ?? []);

        return redirect()->route('citizens.show', $citizen)
                       ->with('success', 'Citizen record updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Citizen $citizen): RedirectResponse
    {
        $citizen->update(['status' => 'inactive', 'updated_by' => auth()->id()]);

        return redirect()->route('citizens.index')
                       ->with('success', 'Citizen record deactivated successfully!');
    }

    /**
     * Get statistics for the dashboard.
     */
    public static function getStats()
    {
        $categories = Category::where('is_active', true)->get()->pluck('id')->toArray();
        
        $stats = [
            'total_citizens' => Citizen::active()->count(),
            'male' => Citizen::active()->byGender('Male')->count(),
            'female' => Citizen::active()->byGender('Female')->count(),
        ];

        // Add count for each active category
        foreach ($categories as $categoryId) {
            $category = Category::find($categoryId);
            $stats[strtolower($category->slug)] = Citizen::active()->byCategory($categoryId)->count();
        }

        return $stats;
    }

    /**
     * Export filtered citizens to PDF
     */
    public function exportPdf(Request $request)
    {
        $query = Citizen::active();

        // Apply same filters as index
        if ($request->filled('search')) {
            $query->search($request->search);
        }

        if ($request->filled('gender') && $request->gender !== 'all') {
            $query->byGender($request->gender);
        }

        if ($request->filled('civil_status') && $request->civil_status !== 'all') {
            $query->byCivilStatus($request->civil_status);
        }

        if ($request->filled('age_group') && $request->age_group !== 'all') {
            $query->byAgeGroup($request->age_group);
        }

        if ($request->filled('category_id') && $request->category_id !== 'all') {
            $query->byCategory($request->category_id);
        }

        $citizens = $query->with(['categories', 'createdBy'])
                          ->orderBy('last_name', 'asc')
                          ->get();

        // Determine filter description for the PDF
        $filterDescription = $this->getFilterDescription($request);

        // Get selected columns for the PDF
        $columns = [
            'name' => true, // Always included
            'gender' => $request->has('include_gender'),
            'age' => $request->has('include_age'),
            'birthdate' => $request->has('include_birthdate'),
            'civil_status' => $request->has('include_civil_status'),
            'contact' => $request->has('include_contact'),
            'pcn' => $request->has('include_pcn'),
            'occupation' => $request->has('include_occupation'),
            'status' => $request->has('include_status'),
            'categories' => $request->has('include_categories'),
        ];

        $pdf = \PDF::loadView('citizens.export-pdf', compact('citizens', 'filterDescription', 'columns'));
        
        return $pdf->download('barangay50_citizens_' . date('Y-m-d_His') . '.pdf');
    }

    /**
     * Generate human-readable filter description
     */
    private function getFilterDescription(Request $request): string
    {
        $filters = [];

        if ($request->filled('search')) {
            $filters[] = "Search: {$request->search}";
        }

        if ($request->filled('gender') && $request->gender !== 'all') {
            $filters[] = "Gender: {$request->gender}";
        }

        if ($request->filled('civil_status') && $request->civil_status !== 'all') {
            $filters[] = "Civil Status: {$request->civil_status}";
        }

        if ($request->filled('age_group') && $request->age_group !== 'all') {
            $ageGroupLabel = [
                'children' => 'Children (0-12)',
                'youth' => 'Youth (13-24)',
                'adult' => 'Adult (25-59)',
                'senior' => 'Senior (60+)'
            ][$request->age_group] ?? $request->age_group;
            $filters[] = "Age Group: {$ageGroupLabel}";
        }

        if ($request->filled('category_id') && $request->category_id !== 'all') {
            $category = Category::find($request->category_id);
            if ($category) {
                $filters[] = "Category: {$category->name}";
            }
        }

        return count($filters) > 0 ? implode(' | ', $filters) : 'All Active Citizens';
    }

    /**
     * Download the citizen's profile picture
     */
    public function downloadProfilePicture(Citizen $citizen)
    {
        if (!$citizen->profile_picture || !\Storage::disk('public')->exists($citizen->profile_picture)) {
            return redirect()->back()->with('error', 'Profile picture not found.');
        }

        $filename = $citizen->full_name . '_profile_' . date('Y-m-d') . '.' . pathinfo($citizen->profile_picture, PATHINFO_EXTENSION);
        return \Storage::disk('public')->download($citizen->profile_picture, $filename);
    }

    /**
     * Download the citizen's national ID photo
     */
    public function downloadNationalIdPhoto(Citizen $citizen)
    {
        if (!$citizen->national_id_photo || !\Storage::disk('public')->exists($citizen->national_id_photo)) {
            return redirect()->back()->with('error', 'National ID photo not found.');
        }

        $filename = $citizen->full_name . '_national_id_' . date('Y-m-d') . '.' . pathinfo($citizen->national_id_photo, PATHINFO_EXTENSION);
        return \Storage::disk('public')->download($citizen->national_id_photo, $filename);
    }
}
