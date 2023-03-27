<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_technology_new', function (Blueprint $table) {
            $table->unsignedBigInteger('post_id')->nullable();

            $table->foreign('post_id')
                ->references('id')
                ->on('posts');

            $table->unsignedBigInteger('technology_id')->nullable();

            $table->foreign('technology_id')
                ->references('id')
                ->on('technologies');

            $table->primary(['post_id', 'technology_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('post_technology');
    }
};
