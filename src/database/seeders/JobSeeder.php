<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JobSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('jobs')->insert([
            ['title' => 'مهندس'],
            ['title' => 'دکتر'],
            ['title' => 'کارگر'],
            ['title' => 'جوشکار'],
            ['title' => 'آرماتوربند'],
            ['title' => 'سیستمی'],
            ['title' => 'راننده'],
            ['title' => 'دانشجو'],
            ['title' => 'کارمند'],
            ['title' => 'بزاز'],
            ['title' => 'بازاری'],
            ['title' => 'نگهبان'],
            ['title' => 'فوق تخصص'],
            ['title' => 'نجار'],
            ['title' => 'طلبه'],
            ['title' => 'کشاورز'],
        ]);
    }
}
