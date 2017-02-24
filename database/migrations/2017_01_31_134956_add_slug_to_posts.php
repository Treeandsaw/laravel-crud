<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSlugToPosts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('posts', function($table) {

            $table->string('slug', 100)->after('body')->default('test.jpg');
            $table->string('author', 30)->after('slug');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('posts', function($table) {

            $table->dropColumn('slug');
            $table->dropColumn('author');

        });
    }
}
