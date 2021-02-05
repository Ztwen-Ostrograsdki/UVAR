<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $levels = ['beginner', 'level-1', 'level-2', 'level-3', 'level-4'];
        Schema::create('members', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->boolean('authorized')->default(false);
            $table->string('IDENTIFY')->unique();
            $table->string('name')->unique();
            $table->string('email')->unique();
            $table->string('pseudo')->nullable();
            $table->string('phone')->unique();
            $table->string('country')->nullable();
            $table->enum('sexe', ['female', 'male'])->default('male');
            $table->timestamps();
            $table->softDeletes();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('referer')->nullable();
            $table->foreign('user_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
            $table->float('amount')->nullable();
            $table->float('AR-coin')->nullable();
            $table->enum('level', ['beginner', 'level-1', 'level-2', 'level-3', 'level-4'])->default('beginner');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('members');
    }
}
