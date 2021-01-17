<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->text('order');
            $table->decimal('price');
            $table->string('order_id')->primary()->unique();
            $table->string('ordered_by');
            $table->boolean('cancelled')->default(false);
            $table->boolean('completed')->default(false);
            $table->timestamps();
            $table->foreign('ordered_by')->references('user_id')->on('users')
                ->onDelete('cascade');
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
