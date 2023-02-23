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
        Schema::create('ndinga_loans', function (Blueprint $table) {
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
            $table->string('vehicle_type')->unsigned();;
            $table->string('vehicle_name')->unsigned();;
            $table->string('vehicle_registration_number')->unsigned();;
            $table->string('vehicle_chassis_number')->unsigned();;
            $table->string('vehicle_color')->unsigned();;
            $table->string('vehicle_model')->unsigned();;
            $table->string('first_vehicle_photo')->unsigned();;
            $table->string('second_vehicle_photo')->unsigned();;
            $table->string('third_vehicle_photo')->unsigned();;
            $table->string('fourth_vehicle_photo')->unsigned();;
            $table->string('vehicle_insurance_provider')->unsigned();;
            $table->string('vehicle_insurance_type')->unsigned();;
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
        Schema::dropIfExists('ndinga_loans');
    }
};
