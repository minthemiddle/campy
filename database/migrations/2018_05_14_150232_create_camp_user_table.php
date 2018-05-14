<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCampUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('camp_user', function (Blueprint $table) {
            $table->integer('camp_id')->unsigned()->nullable();
            $table->integer('user_id')->unsigned()->nullable();
            $table->enum('status', ['interested', 'registered', 'confirmed', 'cancelled', 'waiting'])->nullable();
            $table->enum('contribution', ['waiver', 'payer', 'winner', 'paid'])->nullable();
            $table->enum('laptop', ['own', 'waiver', 'payer', 'winner', 'paid'])->nullable();
            $table->boolean('tos')->default(0);
            $table->boolean('consent')->default(0);
            $table->text('comment')->nullable();
            $table->text('reason_for_cancellation')->nullable();
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
        Schema::dropIfExists('camp_user');
    }
}
