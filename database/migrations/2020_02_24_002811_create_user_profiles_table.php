<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_profiles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id')->unsigned()->unique();
            $table->string('name', 100)->nullable()->comment('氏名');
            $table->string('name_kana', 100)->nullable()->comment('氏名カナ');
            $table->date('birthday')->nullable()->comment('生年月日');
            $table->tinyInteger('gender')->nullable()->comment('性別');
            $table->tinyInteger('status')->nullable()->comment('ステータス');
            $table->text('detail')->nullable()->comment('詳細説明 - 経歴・スキル・資格・関わったプロジェクトなど');
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_profiles');
    }
}
