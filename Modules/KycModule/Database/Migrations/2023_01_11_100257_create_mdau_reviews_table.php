<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mdau_reviews', function (Blueprint $table) {
          $table->id();
          $table->integer('mdau_id');
          $table->integer('user_id');
          $table->integer('step_id');
          $table->longText('review')->default('Not reviewed');
          $table->string('status')->default('Pending');
          $table->integer('is_accepted')->default(0);
          $table->integer('magnitude')->default(1);
          $table->integer('is_reviewed')->default(0);
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
        Schema::dropIfExists('mdau_reviews');
    }
};
