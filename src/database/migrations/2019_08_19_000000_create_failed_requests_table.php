<?php

use \App\Classes\Consts;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('failed_requests', function (Blueprint $table) {

            //keys
            $table->id();

            //columns
            $table->string('ip')->nullable();
            $table->string('phone')->nullable();
            $table->text('message')->nullable();

            $table->enum('stage', Consts::FAILED_REQUESTS_STAGES);

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
        Schema::dropIfExists('failed_jobs');
    }
};
