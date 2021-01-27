<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->float('amount');
            $table->string('operator');
            $table->string('operator_id_transaction');
            $table->string('description')->nullable();
            $table->enum('type', ['member_to_uvar', 'uvar_to_member', 'member_to_member']);
            $table->timestamps();
            $table->unsignedBigInteger('sender');
            $table->unsignedBigInteger('receiver');
            $table->foreign('sender')
                  ->references('id')
                  ->on('members')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
            $table->foreign('receiver')
                  ->references('id')
                  ->on('members')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
}
