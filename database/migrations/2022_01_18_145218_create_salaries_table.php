<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('salaries', function (Blueprint $table) {
            
            $table->integer('s_id')->default(0);
            $table->integer('package')->default(0);
            $table->integer('rent_allowance')->default(0);
            $table->integer('basic_pay')->default(0);
            $table->integer('variable_salary')->default(0);
            $table->integer('gratuity')->default(0);
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
        Schema::dropIfExists('salaries');
    }
}
