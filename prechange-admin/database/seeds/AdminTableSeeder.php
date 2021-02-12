<?php

use Illuminate\Database\Seeder;
use App\Models\Admin;

class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Admin::query()->truncate();
        
        DB::table('admins')->insert(
        [
            'email' => 'demo@admin.com',
            // 'password' => bcrypt('B*trota-Admin2019.!?-'),
            'password' => bcrypt('admin@2020'),
        ]);
    }
}
