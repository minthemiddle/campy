<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FixCampNullableColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('camps', function (Blueprint $table) {
            $table->text('shortcode')->nullable()->change();
            $table->text('city')->nullable()->change();
            $table->integer('max')->nullable()->change();
            $table->date('from')->nullable()->change();
            $table->date('to')->nullable()->change();
            $table->date('registration_start')->nullable()->change();
            $table->date('registration_end')->nullable()->change();
            $table->text('url')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
