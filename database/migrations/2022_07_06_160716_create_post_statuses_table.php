<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostStatusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('post_statuses')) {
            Schema::create('post_statuses', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->string('bg_color');
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
        Schema::dropIfExists('post_statuses');
    }
}
