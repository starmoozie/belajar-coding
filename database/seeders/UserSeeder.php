<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory(10)->create();

        $data = $this->data();

        User::updateOrCreate([
            'email' => $data['email']
        ], $data);
    }

    private function data()
    {
        return [
            'name' => 'admin',
            'email' => 'admin@example.com',
            'email_verified_at' => now(),
            'password' => \Hash::make('password'), // password
            'remember_token' => \Str::random(10),
            'role_id'        => Role::first()->id,
        ];
    }
}
