<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenuRoleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('menu_role')){

            Schema::create('menu_role', function (Blueprint $table) {
                $table->id();
                $table->foreignId('menu_id')->references('id')->on('menu')->onDelete('cascade');
                $table->foreignId('role_id')->references('id')->on('roles')->onDelete('cascade');
                $table->integer('index')->default(0);
                $table->integer('create')->default(0);
                $table->integer('edit')->default(0);
                $table->integer('show')->default(0);
                $table->integer('print')->default(0);
                $table->integer('destroy')->default(0); 
                $table->timestamps();
                $table->softDeletes($column = 'deleted_at')->nullableTimestamps();
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
        Schema::dropIfExists('menu_role');
    }
}
