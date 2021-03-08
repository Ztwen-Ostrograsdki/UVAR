<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('actions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('description')->nullable();
            $table->string('name');
            $table->boolean('bought')->default(false);
            $table->unsignedBigInteger('total')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->unsignedBigInteger('actionnary')->nullable();
            $table->foreign('actionnary')
                  ->references('id')
                  ->on('members')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
            $table->decimal('price', 12, 2)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('actions');
    }
}
