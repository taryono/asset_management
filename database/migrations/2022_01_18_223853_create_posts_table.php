<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('posts')) {
            Schema::create('posts', function (Blueprint $table) {
                $table->id();
                $table->string('title');
                $table->foreignId('parent_id');
                $table->foreignId('template_id');
                $table->foreignId('category_id');
                $table->foreignId('post_status_id');
                $table->integer('year');
                $table->integer('month');
                $table->date('publish_date');
                $table->string('meta');
                $table->string('author');
                $table->text('content');
                $table->text('written_by');
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
        Schema::dropIfExists('posts');
    }
}
