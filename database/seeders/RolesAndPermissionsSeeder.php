<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Permission::create(['name' => 'dashboard']);
        Permission::create(['name' => 'patient dashboard']);
        Permission::create(['name' => 'doctor dashboard']);
        Permission::create(['name' => 'patient make medical appointment']);
        Permission::create(['name' => 'patient list appointments']);
        Permission::create(['name' => 'medical history']);
        
        $patient = Role::create(['name' => 'patient']);
        $patient->givePermissionTo([
            'patient dashboard',
            'patient make medical appointment',
            'patient list appointments',
            'dashboard',
            'medical history'
        ]);

        $doctor = Role::create(['name' => 'doctor']);
        $doctor->givePermissionTo([
            'medical history',
            'doctor dashboard'
        ]);
    }
}
