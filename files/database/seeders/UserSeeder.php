<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory()
            ->superuser()
            ->create([
                'email' => 'admin@example.com',
                'name' => 'admin',
                'password' => Hash::make('kkkkkkkk'),
            ]);
    }
}
