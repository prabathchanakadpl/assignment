<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('number_sequences', function (Blueprint $table) {
            $table->id();
            $table->string('type','100')->unique();
            $table->string('prefix')->nullable();
            $table->integer('number');
            $table->integer('number_length');// length without prefix and suffix
            $table->string('suffix')->nullable();
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
        Schema::dropIfExists('number_sequences');
    }
};
