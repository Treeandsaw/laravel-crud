<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReplyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reply', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name'); 
            $table->text('reply'); 
            $table->integer('comment_id')->unsigned();
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
        //
    }
}
