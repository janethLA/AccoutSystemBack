<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIncomeUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('income_users', function (Blueprint $table) {
            $table->id();

            $table->date('date')->nullable();
            $table->string('month')->nullable();
            $table->string('concept')->nullable();
            $table->double('amount', 11, 2)->nullable();
            $table->string('comment')->nullable();

            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('income_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('income_id')->references('id')->on('incomes')->onDelete('cascade');

            //$table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('income_users');
    }
}
