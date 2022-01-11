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
            // $table->string('code');
            $table->string('problem'); //ปัญหา
            $table->integer('equipment_id');
            $table->string('details')->nullable(); //รายละเอียด

            $table->string('status');
            $table->string('fileImage')->nullable();
            $table->string('type_file')->nullable();
            $table->decimal('price', 10, 2)->nullable();
            $table->string('guaranty')->nullable(); //ประกัน
            $table->dateTime('set_at'); //กำหนดส่งคืน

            $table->integer('user_id_created');
            $table->integer('user_id_updated');
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
