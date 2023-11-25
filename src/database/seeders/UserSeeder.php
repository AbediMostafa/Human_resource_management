<?php

namespace Database\Seeders;

use App\Models\Applicant;
use App\Models\Role;
use App\Models\User;
use App\Models\UserSpec;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        User::factory()
            ->has(
                Applicant::factory()
                    ->count(rand(1, 2))
            )
            ->count(10)
            ->create();

        User::all()->each(
            function ($user) {
                $user->attachRoles(Role::get()->shuffle()->take(rand(1, 3)));
            }
        );
    }
}
