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
        Schema::create('mtajipap_loan_guarantor_people', function (Blueprint $table) {
          $table->id();
          $table->integer('mtajipap_id');
          $table->string('first_name');
          $table->string('middle_name');
          $table->string('last_name');
          $table->string('identity_type');
          $table->string('identity');
          $table->string('identity_path');
          $table->string('phone');
          $table->string('relationship');
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
        Schema::dropIfExists('mtajipap_loan_guarantor_people');
    }
};
