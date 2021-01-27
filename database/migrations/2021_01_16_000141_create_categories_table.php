<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->softDeletes();
            $table->string('name')->unique();
            $table->string('creator')->nullable();
            $table->string('editor')->nullable();
            $table->foreign('creator')
                  ->references('id')
                  ->on('members')
                  ->onDelete('restrict')
                  ->onUpdate('restrict');
            $table->foreign('creator')
                  ->references('id')
                  ->on('members')
                  ->onDelete('restrict')
                  ->onUpdate('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categories');
    }
}