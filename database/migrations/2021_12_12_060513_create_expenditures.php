<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExpenditures extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('expenditures')){

            Schema::create('expenditures', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->foreignId('type_id');
                $table->foreignId('category_id');
                $table->text('description');
                $table->foreignId('post_status_id');
                $table->integer('year');
                $table->integer('month');
                $table->date('publish_date');
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
        Schema::dropIfExists('expenditures');
    }
}
