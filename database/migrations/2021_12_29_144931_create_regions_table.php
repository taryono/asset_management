<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('regions')){
            Schema::create('regions', function (Blueprint $table) {
                $table->id();
                $table->string('name', 255); 
                $table->foreignId('country_id')->references('id')->on('countries');
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
        Schema::dropIfExists('regions');
    }
}
