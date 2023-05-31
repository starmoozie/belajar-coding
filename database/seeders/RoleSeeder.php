<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\Menu;

class RoleSeeder extends Seeder
{
    const DATA = [
        ['name' => 'admin'],
        ['name' => 'user']
    ];

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (Self::DATA as $value) {
            $role = Role::updateOrCreate($value, $value);
            $role->menu()->sync(Menu::pluck('id')->toArray());
        }
    }
}
