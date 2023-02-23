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
        Schema::create('mtajipap_loans', function (Blueprint $table) {
          $table->id();
          $table->integer('customer_id');
          $table->integer('category_id');
          $table->integer('amount')->default(0);
          $table->text('amount_words')->unsigned();;
          $table->string('work_business')->unsigned();;
          $table->string('intension')->unsigned();;
          $table->integer('dependants_count')->unsigned();;
          $table->integer('income_perday')->unsigned();;
          $table->integer('income_perweek')->unsigned();;
          $table->integer('income_permonth')->unsigned();;
          $table->integer('income_peryear')->unsigned();;
          $table->longText('other_properties')->unsigned();;

          $table->string('market_manager_name')->unsigned();;
          $table->string('title')->unsigned();;
          $table->string('market_name')->unsigned();;
          $table->string('market_region')->unsigned();;
          $table->string('market_district')->unsigned();;
          $table->string('market_ward')->unsigned();;
          $table->string('market_manager_phone')->unsigned();;
          $table->string('market_leadership_letter')->unsigned();;
          $table->integer('is_submited')->default(0);
          $table->integer('is_completed')->default(0);
          $table->integer('is_accepted')->default(0);
          $table->integer('current_step')->default(0);
          $table->string('status')->default('Pending');
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
        Schema::dropIfExists('mtajipap_loans');
    }
};
