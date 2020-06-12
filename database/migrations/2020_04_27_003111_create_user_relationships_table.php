<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserRelationshipsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_relationships', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('follower_id')->unsigned();
            $table->bigInteger('follow_id')->unsigned();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('follower_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('follow_id')->references('id')->on('users')->onDelete('cascade');
            $table->unique(['follower_id', 'follow_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_relationships');
    }
}
