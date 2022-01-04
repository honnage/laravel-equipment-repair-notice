<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEquipmentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('equipment', function (Blueprint $table) {
            $table->id();
            // $table->integer('category_id'); //รหัสหมวดหมู่
            $table->integer('type_equipment_id'); //รหัสประเภท
            $table->string('name'); //ชื่อครุภัณฑ์
            $table->string('equipment_number'); //หมายเลขครุภัณฑ์
            $table->date('purchase_date'); //วันที่ซื้อ
            $table->string('insurance'); //อายุประกัน
            $table->decimal('price', 10, 2); //ราคา
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
        Schema::dropIfExists('equipment');
    }
}