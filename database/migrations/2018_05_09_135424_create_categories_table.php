<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    //thuc hien khi goi lenh migrate database
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            //kieu so nguyen tu dong tang: increment
            $table->increments('id');
            $table->string('name');
            $table->string('slug');
            $table->string('image')->default('default.png');
            //tu dong them 2 fields: created_at, updated_at
            //created_at: tu dong fill khi them moi record
            //updated_at: tu dong them khi update record
            //ca 2 deu tu dong lay thoi gian hien tai
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
        Schema::dropIfExists('categories');
    }
}
