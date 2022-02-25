<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActivitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql2')->create('activities', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('causer');
            $table->string('causer_info');
            $table->string('causer_type');
            $table->string('path');
            $table->string('method');
            $table->string('parameters');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('activities');
    }
}
