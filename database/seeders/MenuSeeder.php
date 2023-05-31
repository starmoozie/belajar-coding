<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Menu as MenuModel;
use App\Constants\Menu as MenuConstant;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (MenuConstant::ALL as $menu) {
            foreach ($menu['permissions'] as $permission) {
                MenuModel::updateOrCreate([
                    'value' => $menu['value'],
                    'permission' => $permission
                ], [
                    'label' => $menu['label'],
                    'value' => $menu['value'],
                    'permission' => $permission
                ]);
            }
        }
    }
}
