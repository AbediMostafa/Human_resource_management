<?php

namespace Database\Factories;

use App\Classes\Consts;
use App\Models\City;
use App\Models\Color;
use App\Models\Country;
use App\Models\FieldOfStudy;
use App\Models\Originality;
use App\Models\State;
use App\Models\University;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Applicant>
 */
class ApplicantFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'uid' => implode(fake()->randomElements(['a', 'b', 'c', 'd', 'e', 'f', 'g'])) . rand(0, 1000) . rand(0, 1000),
            'age' => fake()->numberBetween(13, 50),
            'international_code' => Hash::make(rand(154, 988888844)),
            'encrypted_international_code' => Hash::make(rand(154, 988888844)),
            'status' => fake()->randomElement(Consts::APPLICANT_STATUS),
            'first_name' => fake()->firstName(),
            'last_name' => fake()->lastName(),
            'presenter' => fake()->lastName(),
            'gender' => fake()->randomElement(['male', 'female']),
            'graduated' => fake()->randomElement([true, false]),
            'field_of_study_id' => fake()->randomElement(FieldOfStudy::all()->pluck('id')->toArray()),
            'grade' => fake()->randomElement(Consts::GRADE),
            'last_education_place' => fake()->text(20),
            'study_country' => fake()->randomElement(Country::all()->pluck('id')->toArray()),
            'study_district' => fake()->word(),
            'have_job' => fake()->randomElement([true, false]),
            'job' => fake()->randomElement(Consts::JOB),
            'has_special_disease' => fake()->word(),
            'has_disability' => fake()->word(),
            'description' => fake()->sentence(),
            'presenter_id' => fake()->randomElement(User::all()->pluck('id')->toArray()),
        ];
    }
}
