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
        Schema::create('users', function (Blueprint $table) {

            //keys
            $table->id();

            //columns
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->enum('gender', ['male', 'female'])->nullable();
            $table->enum('state', Consts::USER_STATES)->default('new');
            $table->enum('grade', Consts::GRADE)->nullable();
            $table->unsignedSmallInteger('age')->nullable();
            $table->string('international_code')
                ->unique()
                ->nullable();

            $table->string('hashed_international_code')
                ->unique()
                ->nullable();

            $table->string('password')->nullable();

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
        Schema::dropIfExists('users');
    }
};
