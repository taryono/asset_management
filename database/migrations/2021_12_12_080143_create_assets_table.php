<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('assets')){

            Schema::create('assets', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->foreignId('asset_type_id');
                $table->foreignId('asset_status_id');
                $table->foreignId('asset_category_id');
                $table->integer('amount');
                $table->float('price');
                $table->string('description');
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
        Schema::dropIfExists('assets');
    }
}
