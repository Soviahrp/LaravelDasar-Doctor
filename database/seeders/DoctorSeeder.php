<?php

namespace Database\Seeders;

use App\Models\Doctor;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DoctorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         Doctor::insert([
            [
                'uuid' => Str::uuid(),
                'name' => 'Dr. John Doe',
                'email' => 'jgjVI@example.com',
                'phone' => '081234567890',
                'gender' => 'male'
            ],
            [
                'uuid' => Str::uuid(),
                'name' => 'Dr. Dayana',
                'email' => 'hk9z0@example.com',
                'phone' => '081234567890',
                'gender' => 'female'
            ],

            ]);
    }
}
