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
        Schema::create('mdau_loan_other_debts', function (Blueprint $table) {
          $table->id();
          $table->integer('mdau_id');
          $table->integer('amount');
          $table->string('debt_institution');
          $table->date('finish_date');
          $table->string('region');
          $table->string('district');
          $table->string('ward');
          $table->string('phone');
          $table->string('registration_number');
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
        Schema::dropIfExists('mdau_loan_other_debts');
    }
};
