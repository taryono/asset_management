<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('menus')){

            Schema::create('menus', function (Blueprint $table) {
                $table->id();
                $table->string('type')->nullable();
                $table->string('name');
                $table->string('url');
                $table->string('action');
                $table->integer('parent_id')->references('id')->on('menus');
                $table->foreignId('menu_type_id')->references('id')->on('menu_types');
                $table->integer('is_active');
                $table->integer('sequence')->nullable();
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
        Schema::dropIfExists('menus');
    }
}
