<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderTbl extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id('id');
            $table->integer('cat_id');
            $table->integer('client_id');
            $table->integer('code')->nullabe();
            $table->integer('type');
            $table->integer('pin');
            $table->string('title_ru');
            $table->string('title_uz');
            $table->text('text_uz');
            $table->text('text_ru');
            $table->float('price');
            $table->integer('rate');
            $table->integer('pay_status');
            $table->integer('view');
            $table->date('start_date');
            $table->date('end_date');
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
        Schema::dropIfExists('orders');
    }
}