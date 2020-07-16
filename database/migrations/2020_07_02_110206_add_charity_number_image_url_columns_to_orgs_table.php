<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCharityNumberImageUrlColumnsToOrgsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orgs', function (Blueprint $table) {
            $table->integer('charity_number')->after('display_name');
            $table->string('image_filename')->after('charity_number');
            $table->string('image_url')->after('image_filename');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orgs', function (Blueprint $table) {
            $table->dropColumn('charity_number');
            $table->dropColumn('image_filename');
            $table->dropColumn('image_url');
        });
    }
}
