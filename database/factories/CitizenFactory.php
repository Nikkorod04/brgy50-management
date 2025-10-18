<?php

namespace Database\Factories;

use App\Models\Citizen;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Citizen>
 */
class CitizenFactory extends Factory
{
    protected $model = Citizen::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $gender = $this->faker->randomElement(['Male', 'Female', 'Other']);
        $civilStatus = $this->faker->randomElement(['Single', 'Married', 'Divorced', 'Widowed', 'Separated', 'Annulled']);

        return [
            'first_name' => $this->faker->firstName($gender === 'Male' ? 'male' : 'female'),
            'middle_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'suffix' => $this->faker->randomElement([null, 'Jr.', 'Sr.', 'III', 'II']),
            'email' => $this->faker->unique()->safeEmail(),
            'phone' => $this->faker->phoneNumber(),
            'address' => $this->faker->streetAddress(),
            'barangay' => 'Barangay 50',
            'city' => 'Tacloban City',
            'province' => 'Leyte',
            'postal_code' => $this->faker->postcode(),
            'birthdate' => $this->faker->dateTimeBetween('-80 years', '-18 years'),
            'age' => $this->faker->numberBetween(18, 80),
            'gender' => $gender,
            'civil_status' => $civilStatus,
            'occupation' => $this->faker->jobTitle(),
            'educational_attainment' => $this->faker->randomElement(['Elementary', 'High School', 'Vocational', 'College', 'Graduate']),
            'pcn' => $this->faker->unique()->regexify('[0-9]{4}-[0-9]{4}-[0-9]{4}-[0-9]{4}'),
            'notes' => $this->faker->paragraph(),
            'created_by' => 1,
            'updated_by' => 1,
            'status' => 'active',
        ];
    }
}
