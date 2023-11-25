<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            [
                'name'=>'admin',
                'display_name'=>'مدیر برنامه',
                'description'=>'کاربر تمامی دسترسی ها را دارد'
            ],
            [
                'name' => 'developer',
                'display_name' => 'برنامه نویس',
                'description' => 'مانند مدیر تمامی دسترسی ها را دارد'
            ],
            [
                'name' => 'user',
                'display_name' => 'کاربر',
                'description' => 'این کاربر توانایی ایجاد متقاضی و درخواست و کارهایی از این قبیل را دارد'
            ],
        ]);
    }
}
