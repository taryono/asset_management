<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateControllersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('controllers')){

            Schema::create('controllers', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->string('url');
                $table->foreignId('group_menu_id');
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
        Schema::dropIfExists('controllers');
    }
}
