<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('company_id')->unsigned();
            $table->bigInteger('user_id')->unsigned();
            $table->string('department', 100)->nullable()->comment('部署');
            $table->string('position', 100)->nullable()->comment('役職');
            $table->string('tel')->nullable()->comment('電話番号');
            $table->tinyInteger('status')->comment('ステータス: 0=申請中, 1=承認済');
            $table->tinyInteger('role')->comment('権限: 1=管理者権限, 2=一般ユーザー');
            $table->boolean('main')->comment('主要な企業かどうか');
            $table->timestamps();

            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->unique(['company_id', 'user_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employees');
    }
}
