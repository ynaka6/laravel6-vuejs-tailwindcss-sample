<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 100)->comment('企業名カナ');
            $table->string('name_kana', 100)->nullable()->comment('企業名カナ');
            $table->string('ceo', 50)->nullable()->comment('代表取締役');
            $table->string('founded', 50)->nullable()->comment('設立年月日');
            $table->string('url')->nullable()->comment('サイトURL');
            $table->string('email')->nullable()->comment('問い合わせメールアドレス');
            $table->string('tel')->nullable()->comment('電話番号');
            $table->string('fax')->nullable()->comment('FAX番号');
            $table->string('postal_code', 10)->nullable()->comment('郵便番号');
            $table->string('address')->nullable()->comment('住所');
            $table->text('business')->nullable()->comment('事業内容');
            $table->string('plan_slug', 20)->nullable()->comment('プランSlug');
            $table->timestamps();
            $table->foreign('plan_slug')->references('slug')->on('plans')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('companies');
    }
}
