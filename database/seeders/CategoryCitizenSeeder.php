<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Citizen;
use Illuminate\Database\Seeder;

class CategoryCitizenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = Category::where('is_active', true)->get();
        $citizens = Citizen::all();

        foreach ($citizens as $citizen) {
            // Randomly assign 0-2 categories to each citizen
            $randomCategories = $categories->random(rand(0, 2))->pluck('id');
            $citizen->categories()->sync($randomCategories);
        }
    }
}
