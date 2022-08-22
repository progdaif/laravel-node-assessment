<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class () extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->timestamp('departed_at')->index();
            $table->timestamp('arrived_at')->index();
            $table->unsignedBigInteger('user_id')->index();
            $table->unsignedTinyInteger('payment_status')->default(0)->index();
            $table->float('price')->default(0);
            $table->timestamps();

            // to access a specific reservation
            $table->index(['id', 'user_id']);


            // to access reservations in time range
            $table->index(['departed_at', 'arrived_at']);

            // to access reservations in time range for specific user
            $table->index(['departed_at', 'arrived_at', 'user_id']);

            // to access reservations based on payment_status for specific user
            $table->index(['user_id', 'payment_status']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reservations');
    }
};