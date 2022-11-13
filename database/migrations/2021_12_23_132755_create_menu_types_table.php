<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenuTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('menu_types')){
            Schema::create('menu_types', function (Blueprint $table) {
                $table->id();
                $table->string('name'); 
                $table->string('description')->nullable();
                $table->string('bg_color');
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
        Schema::dropIfExists('menu_types');
    }
}
