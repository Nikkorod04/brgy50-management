<?php

namespace Database\Seeders;

use App\Models\Citizen;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CitizenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get the admin user
        $admin = User::where('username', 'brgy50')->first();
        
        if (!$admin) {
            return;
        }

        $firstNames = [
            'Juan', 'Maria', 'Jose', 'Ana', 'Pedro', 'Rosa', 'Miguel', 'Isabel', 'Francisco', 'Carmen',
            'Luis', 'Lucia', 'Diego', 'Sofia', 'Antonio', 'Elena', 'Ramon', 'Esperanza', 'Manuel', 'Felicia',
            'Ricardo', 'Margarita', 'Eduardo', 'Josefina', 'Guillermo', 'Matilde', 'Salvador', 'Emilia', 'Ruperto', 'Patricia',
            'Alejandro', 'Gabriela', 'Benjamin', 'Veronica', 'Domingo', 'Claudia', 'Ernesto', 'Monica', 'Fernando', 'Angela',
            'Hector', 'Victoria', 'Julio', 'Alexandra', 'Ignacio', 'Melissa', 'Jonathan', 'Diana', 'Leonardo', 'Stephanie'
        ];

        $lastNames = [
            'Santos', 'Garcia', 'Rodriguez', 'Martinez', 'Hernandez', 'Lopez', 'Gonzalez', 'Flores', 'Torres', 'Rivera',
            'Velasco', 'Castro', 'Munoz', 'Romero', 'Gutierrez', 'Moreno', 'Navarro', 'Vargas', 'Ramirez', 'Reyes'
        ];

        $streets = [
            'Maharlika Avenue', 'Aquino Street', 'Tahak Road', 'Justice Avenue', 'San Roque Street',
            'Marasbaras Street', 'Libertad Street', 'Bagong Lipunan Street', 'Rizal Street', 'Quezon Avenue'
        ];

        $genders = ['Male', 'Female'];
        $civilStatuses = ['Single', 'Married', 'Divorced', 'Widowed'];
        $occupations = ['Teacher', 'Farmer', 'Driver', 'Vendor', 'Carpenter', 'Nurse', 'Fisherman', 'Housewife', 'Student', 'Retired', 'OFW', 'Business Owner'];
        $educations = ['Elementary', 'High School', 'College', 'Vocational'];

        // Create 50 sample citizens
        for ($i = 0; $i < 50; $i++) {
            $birthdate = now()->subYears(rand(13, 85))->subMonths(rand(0, 11))->subDays(rand(0, 28));
            $age = now()->diffInYears($birthdate);
            
            $isSenior = $age >= 60;
            $isPWD = rand(1, 20) == 1; // 5% chance
            $isLGBTQ = rand(1, 30) == 1; // ~3% chance
            $isSoloParent = rand(1, 25) == 1 && $age >= 25; // ~4% chance, only for adults

            Citizen::create([
                'first_name' => $firstNames[array_rand($firstNames)],
                'middle_name' => $firstNames[array_rand($firstNames)],
                'last_name' => $lastNames[array_rand($lastNames)],
                'suffix' => rand(1, 20) == 1 ? ['Jr.', 'Sr.', 'III', 'II'][rand(0, 3)] : null,
                'email' => 'citizen' . $i . '@barangay50.local',
                'phone' => '09' . rand(10000000, 99999999),
                'address' => rand(1, 999) . ' ' . $streets[array_rand($streets)],
                'barangay' => 'Barangay 50',
                'city' => 'Tacloban City',
                'province' => 'Leyte',
                'postal_code' => '6500',
                'birthdate' => $birthdate,
                'age' => $age,
                'gender' => $genders[array_rand($genders)],
                'civil_status' => $civilStatuses[array_rand($civilStatuses)],
                'is_pwd' => $isPWD,
                'is_senior_citizen' => $isSenior,
                'is_lgbtq' => $isLGBTQ,
                'is_solo_parent' => $isSoloParent,
                'occupation' => $occupations[array_rand($occupations)],
                'educational_attainment' => $educations[array_rand($educations)],
                'notes' => 'Sample citizen record for testing purposes.',
                'created_by' => $admin->id,
                'updated_by' => $admin->id,
                'status' => 'active',
            ]);
        }
    }
}
