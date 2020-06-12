<?php

use Illuminate\Database\Seeder;
use App\Models\Admin;

class AdminsTableSeeder extends Seeder
{

    private $admin;

    public function __construct(Admin $admin)
    {
        $this->admin = $admin;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->admin->create([
            'name' => '管理者',
            'email' => 'admin@sample.com',
            'password' => bcrypt('0okmnji98uhb'),
            'role' => \App\Enums\Models\Admin\Role::Administrator
        ]);
    }
}
