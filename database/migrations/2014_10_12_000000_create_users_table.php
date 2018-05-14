<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('username')->unique();
            $table->enum('role', ['admin', 'user', 'coach'])->default('user')->nullable();
            $table->string('email');
            $table->string('password');
            $table->string('firstname')->nullable();
            $table->string('lastname')->nullable();
            $table->smallInteger('zip')->nullable();
            $table->string('city')->nullable();
            $table->date('birthdate')->nullable();
            $table->integer('referral')->nullable();
            $table->enum('gender', ['m', 'f'])->nullable();
            $table->enum('diet', [
                'normal', 
                'vegetarian', 
                'vegan', 
                'halal', 
                'glutenfree', 
                'lactosefree'])->nullable()->default('normal');
            $table->string('specialities')->nullable();
            $table->integer('camp_id')->unsigned()->nullable();
            $table->integer('legal_guardian_id')->nullable();
            $table->rememberToken();
            $table->timestamps();
            $table->string('guardian_firstname')->nullable();
            $table->string('guardian_lastname')->nullable();
            $table->string('guardian_email')->nullable();
            $table->string('guardian_phone')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
