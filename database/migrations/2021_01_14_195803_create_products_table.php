<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::dropIfExists('products');
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->softDeletes();
            $table->boolean('bought')->default(false);
            $table->string('name')->unique();
            $table->string('description')->nullable();
            $table->unsignedBigInteger('total');
            $table->float('price')->nullable();
            $table->unsignedBigInteger('poster')->default(1)->nullable();
            $table->string('editor')->nullable();
            $table->foreign('poster')
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
        Schema::dropIfExists('products');
    }
}
