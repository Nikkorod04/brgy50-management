<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Persons with Disability (PWD)',
                'slug' => 'persons-with-disability',
                'description' => 'Citizens with disabilities who require special assistance and services',
                'color' => '#DC2626',
                'icon' => '♿',
                'is_active' => true,
            ],
            [
                'name' => 'Senior Citizens',
                'slug' => 'senior-citizens',
                'description' => 'Citizens aged 60 years old and above',
                'color' => '#9333EA',
                'icon' => '👴',
                'is_active' => true,
            ],
            [
                'name' => 'LGBTQ+ Community',
                'slug' => 'lgbtq-community',
                'description' => 'Members of the Lesbian, Gay, Bisexual, Transgender, and Queer community',
                'color' => '#EC4899',
                'icon' => '🏳️‍🌈',
                'is_active' => true,
            ],
            [
                'name' => 'Solo Parents',
                'slug' => 'solo-parents',
                'description' => 'Single parents raising one or more children independently',
                'color' => '#F59E0B',
                'icon' => '👨‍👧',
                'is_active' => true,
            ],
            [
                'name' => 'Household Heads',
                'slug' => 'household-heads',
                'description' => 'Primary decision-makers and leaders of households',
                'color' => '#0284C7',
                'icon' => '👨‍👩‍👧‍👦',
                'is_active' => true,
            ],
        ];

        foreach ($categories as $category) {
            Category::updateOrCreate(
                ['slug' => $category['slug']],
                $category
            );
        }
    }
}
