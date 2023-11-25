<?php

namespace Database\Seeders;

use App\Models\FieldOfStudy;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FieldOfStudySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        FieldOfStudy::insert([
            ['title'=>'مهندسی نرم افزار'],
            ['title'=>'جانورشناسی'],
        ]);
    }
}
