<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResourcesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('resources', function (Blueprint $table) {
            $table->id();
            $table->integer('subject_id');
            $table->string('title');
            $table->integer('user_id');
            $table->string('key_words');
            $table->longText('description');
            $table->string('publisher')->nullable();
            $table->string('language')->nullable();
            $table->longText('other')->nullable();
            $table->string('type')->nullable();
            $table->string('format')->nullable();
            $table->string('identifier')->nullable();
            $table->string('source')->nullable();
            $table->string('relation')->nullable();
            $table->string('coverage')->nullable();
            $table->string('copyrights')->nullable();
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
        Schema::dropIfExists('resources');
    }
}
