<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Actionables extends Migration
{
     /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('actionables', function (Blueprint $table) { 
            $table->bigIncrements('id');            
            $table->timestamps();            
            $table->unsignedBigInteger('action_id');            
            $table->foreign('action_id')                
                  ->references('id')                
                  ->on('actions')                
                  ->onDelete('cascade')                
                  ->onUpdate('cascade');         
            $table->morphs('action'); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
       Schema::dropIfExists('actionable'); 
    }
}
