<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use \App\Classes\Consts;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('applicants', function (Blueprint $table) {
            //keys
            $table->id();

            //معرف
            $table->string('presenter')
                ->nullable();

            $table->string('uid')
                ->nullable()
                ->unique();

            $table->enum('status', Consts::APPLICANT_STATUS);

            $table->integer('age');

            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();

            $table->string('encrypted_international_code')
                ->nullable()
                ->unique();


            $table->string('international_code')
                ->nullable()
                ->unique();

            $table->enum('gender', ['male', 'female']);

            //columns
            $table->unsignedSmallInteger('birth_year');
            $table->enum('birth_month', Consts::PERSIAN_MONTHS);
            $table->unsignedTinyInteger('birth_day');

            $table->foreignId('birth_country')
                ->nullable()
                ->constrained('countries')
                ->nullOnDelete();

            $table->foreignId('birth_state')
                ->nullable()
                ->constrained('states')
                ->nullOnDelete();

            $table->foreignId('birth_city')
                ->nullable()
                ->constrained('cities')
                ->nullOnDelete();

            $table->string('birth_district')->nullable();

            $table->boolean('graduated')->default(false);
            $table->foreignId('field_of_study_id')
                ->nullable()
                ->constrained('field_of_studies')
                ->nullOnDelete();

            $table->enum('grade', Consts::GRADE);

            $table->set('job', Consts::JOB)->nullable();
            $table->string('district_of_residence')->nullable();
            $table->string('future_residence_district')->nullable();
            $table->foreignId('originality_id')
                ->nullable()
                ->constrained('originalities')
                ->nullOnDelete();
            $table->string('has_special_disease')->nullable();
            $table->string('has_disability')->nullable();

            $table->text('description')->nullable();

            $table->foreignId('presenter_id')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            //timestamps
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('applicants');
    }
};
