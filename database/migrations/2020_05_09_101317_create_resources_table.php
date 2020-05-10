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
            $table->foreignId('created_by');
            $table->foreignId('subject_id');
            $table->string('title');
            $table->string('author');
            $table->string('key_words');
            $table->longText('description');
            $table->string('publisher');
            $table->string('language');
            $table->string('source');
            $table->unsignedInteger('format_id');
            $table->timestamps();
            $table->softDeletes();
            $table->foreignId('deleted_by')->nullable();

            $table->foreign('created_by')->references('id')->on('users');
            $table->foreign('subject_id')->references('id')->on('subjects');
            $table->foreign('deleted_by')->references('id')->on('users');
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
