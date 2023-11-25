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
        Schema::create('phones', function (Blueprint $table) {

            //keys
            $table->id();

            //columns
            $table->string('number');
            $table->enum('type', Consts::PHONE_TYPES);
            $table->integer('phoneable_id')->nullable();
            $table->string('phoneable_type');

            $table->unique(['phoneable_id', 'type']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('phones');
    }
};
