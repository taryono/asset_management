<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('cities')){
            Schema::create('cities', function (Blueprint $table) {
                $table->id();
                $table->string('name', 255); 
                $table->foreignId('region_id')->references('id')->on('regions');
                $table->softDeletes($column = 'deleted_at', $precision = 0); 
                $table->timestamps();
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
        Schema::dropIfExists('cities');
    }
}
