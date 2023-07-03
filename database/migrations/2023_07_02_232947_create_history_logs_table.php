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
        Schema::create('history_logs', function (Blueprint $table) {
            $table->id();
            $table->string('model')->comment('model name');
            $table->string('model_id');
            $table->unsignedBigInteger('user_id')->comment("operator's id");
            $table->json('before')->nullable()->comment('json string of original data');
            $table->json('after')->nullable()->comment('json string of updated data');
            $table->json('changes_info')->nullable()->comment('json string of changes data');
            $table->string('operation');
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
        Schema::dropIfExists('history_logs');
    }
};
