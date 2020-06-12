<?php

use Illuminate\Database\Seeder;
use App\Admin;

class TestAdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Admin::class, 20)->create();
    }
}
