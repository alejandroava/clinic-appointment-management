<?php

namespace Database\Seeders;

use App\Models\Doctor;
use App\Models\Patient;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // $this->call(RolesAndPermissionsSeeder::class);

        // Patient::factory(10)->create()->each(function($patient){
        //      $patient->user->assignRole('patient');
        //  });

        Doctor::factory(10)->create()->each(function($doctor){
            $doctor->user->assignRole('doctor');
         });

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
