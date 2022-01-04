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
            $table->id();
            $table->integer('user_id');
            $table->string('device_id');
            $table->string('name');
            $table->string('problem');
            $table->string('category');
            $table->string('details');
            $table->string('status');
            $table->string('note')->nullable();
            $table->decimal('price', 10, 2)->nullable();
            $table->string('fileImage')->nullable();
            $table->string('guaranty')->nullable();
            $table->date('set_at')->nullable();
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
        Schema::dropIfExists('transactions');
    }
}