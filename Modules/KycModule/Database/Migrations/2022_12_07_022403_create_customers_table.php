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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('first_name')->unsigned();;
            $table->string('middle_name')->unsigned();;
            $table->string('surname')->unsigned();;
            $table->string('marital')->unsigned();;
            $table->string('identity_type')->unsigned();;
            $table->string('identity')->unsigned();;
            $table->string('identity_path')->unsigned();;
            $table->string('dob')->unsigned();
            $table->string('phone');
            $table->string('otp');
            $table->string('profile_path')->unsigned();;
            $table->integer('is_verified')->default(0);
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
        Schema::dropIfExists('customers');
    }
};
