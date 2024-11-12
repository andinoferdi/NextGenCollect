<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
   public function run()
{
    $this->call([
        RoleSeeder::class,
        UserSeeder::class,
        MenusSeeder::class,
        SubmenusSeeder::class,
        SettingMenusSeeder::class,
    ]);
}

}
