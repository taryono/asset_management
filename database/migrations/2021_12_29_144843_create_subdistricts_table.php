<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubdistrictsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('subdistricts')){

            Schema::create('subdistricts', function (Blueprint $table) {
                $table->id();
                $table->string('name', 255); 
                $table->foreignId('district_id')->references('id')->on('districts');
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
        Schema::dropIfExists('subdistricts');
    }
}
