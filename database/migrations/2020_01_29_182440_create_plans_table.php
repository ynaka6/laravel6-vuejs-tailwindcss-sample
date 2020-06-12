<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plans', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('slug', 20)->unique()->comment('slug');
            $table->string('name', 100)->unique()->comment('プラン名');
            $table->integer('monthly_price')->comment('月額');
            $table->string('display_monthly_price')->comment('月額表示額');
            $table->integer('yearly_price')->comment('年額');
            $table->string('display_yearly_price')->comment('年額表示額');
            $table->text('description_json')->comment('詳細データのjson');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('plans');
    }
}
