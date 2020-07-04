<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToResourcesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('resources', function (Blueprint $table) {
            $table->string('coverage')->nullable();
            $table->string('contributor')->nullable();
            $table->string('copy_rights')->nullable();
            $table->date('original_date')->nullable();
            $table->string('format')->nullable();
            $table->string('identifier')->nullable();
            $table->string('key_words')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('resources', function (Blueprint $table) {
            $table->dropColumn(['coverage', 'contributor', 'copy_rights', 'original_date', 'format', 'identifier']);
            $table->string('key_words')->change();
        });
    }
}
