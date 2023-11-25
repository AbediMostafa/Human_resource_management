<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        $this->call([
            TagSeeder::class,
            PhoneSeeder::class,
            FieldOfStudySeeder::class,
            UniversitySeeder::class,
            CountrySeeder::class,
            StateSeeder::class,
            CitySeeder::class,
            ColorSeeder::class,
            JobSeeder::class,
            OriginalitySeeder::class,
            RoleSeeder::class,
            PermissionSeeder::class,
            UserSeeder::class,
            AdminSeeder::class,
        ]);
    }
}
