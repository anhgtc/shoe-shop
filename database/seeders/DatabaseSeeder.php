<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Create admin account and provide permission
        $user = \App\Models\User::where('email', '=', 'admin@gmail.com')->first();
        if (!$user) {
            $user = \App\Models\User::create([
                'name' => 'Admin',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('12345678')
            ]);
        }
        $role = \App\Models\Role::firstOrCreate([
            'name' => 'admin'
        ]);
        DB::table('role_user')->insert([
            'role_id' => $role->id,
            'user_id' => $user->id
        ]);
    }
}