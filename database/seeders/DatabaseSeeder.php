<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        Admin::query()->updateOrCreate(['id' => 1], [
            'password' => Hash::make('password'),
        ]);
    }
}
