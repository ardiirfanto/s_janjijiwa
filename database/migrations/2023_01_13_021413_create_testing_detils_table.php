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
        Schema::create('testing_detils', function (Blueprint $table) {
            $table->id();
            $table->foreignId('testing_id')
                ->constrained('testings')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->text('post');
            $table->string('username_twitter');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('testing_detils');
    }
};
