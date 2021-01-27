<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Shoppables extends Migration
{
     /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shoppables', function (Blueprint $table) { 
            $table->bigIncrements('id');            
            $table->timestamps();            
            $table->unsignedBigInteger('user_id');            
            $table->foreign('user_id')                
                  ->references('id')                
                  ->on('users')                
                  ->onDelete('cascade')                
                  ->onUpdate('cascade');         
            $table->morphs('user'); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
       Schema::dropIfExists('shoppable'); 
    }
}
