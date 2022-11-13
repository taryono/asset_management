<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('pages')) {
            Schema::create('pages', function (Blueprint $table) {
                $table->id(); 
                $table->string('name'); 
                $table->integer('parent_id');
                $table->integer('sequence');
                $table->integer('year');
                $table->integer('month');
                $table->date('publish_date');
                $table->foreignId('post_status_id');
                $table->foreignId('template_id');
                $table->string('type'); 
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
        Schema::dropIfExists('pages');
    }
}
