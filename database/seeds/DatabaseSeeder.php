<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        // DBの依存関係を考慮
        $this->call(PlansTableSeeder::class);
        $this->call(BusinessCategoriesTableSeeder::class);
        $this->call(AdminsTableSeeder::class);
    }
}
