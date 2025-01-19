<?php

namespace Database\Seeders;

use Carbon\Carbon;
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
        DB::table('users')->insert([[
            'username' => 'owner',
            'password' => Hash::make('123'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]]);
    }
}
