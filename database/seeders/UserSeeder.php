<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => 'Super Admin',
                'email' => 'ossl@gmail.com',
                'password' => Hash::make('123456789'),
                'owner_id' => 1, // Assuming 1 is the ID of the super admin owner
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
