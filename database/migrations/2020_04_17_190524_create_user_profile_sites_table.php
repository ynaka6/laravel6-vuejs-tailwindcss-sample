<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserProfileSitesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_profile_sites', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_profile_id')->unsigned();
            $table->string('providor')->comment('提供元');
            $table->text('url')->comment('URL');
            $table->timestamps();
            $table->foreign('user_profile_id')->references('id')->on('user_profiles')->onDelete('cascade');
            $table->unique(['user_profile_id', 'providor']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_profile_sites');
    }
}
