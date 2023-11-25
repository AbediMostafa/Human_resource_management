<?php

namespace Database\Seeders;

use App\Models\Phone;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PhoneSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Phone::insert([
            [
                'number' => '09128380348',
                'type' => 'mobile',
                'phoneable_type' => User::class
            ],
            [
                'number' => '09192404569',
                'type' => 'mobile',
                'phoneable_type' => User::class
            ],
            [
                'number' => '09358092651',
                'type' => 'mobile',
                'phoneable_type' => User::class
            ],
            [
                'number' => '09354064244',
                'type' => 'mobile',
                'phoneable_type' => User::class
            ],
            [
                'number' => '09125335323',
                'type' => 'mobile',
                'phoneable_type' => User::class
            ],
            [
                'number' => '09102302279',
                'type' => 'mobile',
                'phoneable_type' => User::class
            ],
            [
                'number' => '09127370348',
                'type' => 'mobile',
                'phoneable_type' => User::class
            ],
            [
                'number' => '09382879279',
                'type' => 'mobile',
                'phoneable_type' => User::class
            ],
            [
                'number' => '09127704926',
                'type' => 'mobile',
                'phoneable_type' => User::class
            ],
            [
                'number' => '09366229457',
                'type' => 'mobile',
                'phoneable_type' => User::class
            ],
            [
                'number' => '09194893376',
                'type' => 'mobile',
                'phoneable_type' => User::class
            ],
            [
                'number' => '09124801584',
                'type' => 'mobile',
                'phoneable_type' => User::class
            ],
            [
                'number' => '09217506678',
                'type' => 'mobile',
                'phoneable_type' => User::class
            ],
        ]);
    }
}
