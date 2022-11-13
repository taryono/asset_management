<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateControllerRoleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('controller_role')){

            Schema::create('controller_role', function (Blueprint $table) {
                $table->id();
                $table->foreignId('role_id')->index();
                $table->foreignId('controller_id')->index();
                $table->integer('index')->index();
                $table->integer('create')->index();
                $table->integer('edit')->index();
                $table->integer('destroy')->index();
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
        Schema::dropIfExists('controller_role');
    }
}
