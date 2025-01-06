<?php

namespace Database\Seeders;

use App\Models\ProjectModel;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ProjectModel::create([
            'name' => 'Admin User',
            'description' => 'asdfasd',
            'year' => 1231,
            'agency' => 'asdf',
            'role' => 'asdf',
        ]);
    }
}
