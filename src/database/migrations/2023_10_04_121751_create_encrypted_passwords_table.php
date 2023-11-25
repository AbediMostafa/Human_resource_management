<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('encrypted_passwords', function (Blueprint $table) {
            $table->foreignId('user_id')
                ->unique()
                ->constrained('users');

            $table->string('encrypted_password');

            $table->unique(['user_id', 'encrypted_password']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('encrypted_passwords');
    }
};
