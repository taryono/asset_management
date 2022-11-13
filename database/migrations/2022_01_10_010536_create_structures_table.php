<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStructuresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('structures')) {
            Schema::create('structures', function (Blueprint $table) {
                $table->id();
                $table->date('start_date'); 
                $table->date('end_date'); 
                $table->timestamps();
                $table->softDeletes($column = 'deleted_at', $precision = 0);
            });
        } 
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('structures');
    }
}
