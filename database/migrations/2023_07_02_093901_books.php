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
        Schema::create('books', function (Blueprint $table) {
            $table->uuid('id');
            $table->string('title', 128)->comment('書名');
            $table->string('author', 64)->comment('作者');
            $table->timestamp('published_at')->nullable()->comment('發佈日期');
            $table->string('category')->nullable()->comment('類別');
            $table->smallInteger('price')->comment('價格');
            $table->smallInteger('quantity')->comment('數量');
            $table->json('images')->nullable()->comment('名稱/路徑');
            $table->unique(['title', 'author']);
            $table->primary('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('books');
    }
};
