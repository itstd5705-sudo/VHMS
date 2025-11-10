<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Doctor;
use App\Models\Employee;
use Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LoginSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
          // 🔹 مدير
        Admin::create([
            'userName' => 'admin2',
            'email' => 'admin2@example.com',
            'password' => Hash::make('123456'),
        ]);

        // 🔹 طبيب
        Doctor::create([
            'fullName' => 'Dr. Sara Mohamed',
            'email' => 'doctor2@example.com',
            'password' => Hash::make('123456'),
            'specialty' => 'Dermatology',
            'phone' => '0922222222',
            'imgUrl' => 'doctor2.jpg',
            'departmentId' => 'nullable', // تأكد أن عندك قسم برقم 1
        ]);

        // 🔹 موظف
        Employee::create([
            'fullName' => 'Hassan Abdallah',
            'email' => 'employee2@example.com',
            'password' => Hash::make('123456'),
            'phone' => '0911111111',
            'imgUrl' => 'employee2.jpg',
        ]);
    }
    }
