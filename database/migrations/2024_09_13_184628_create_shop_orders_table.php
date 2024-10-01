<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('shop_orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->double('subtotal' ,10,2);
            $table->double('shipping' ,10,2);
            $table->string('coupon_code')->nullable();
            $table->double('discount' ,10,2)->nullable();
            $table->double('grand_total' ,10,2);
            // $table->date('order_date');
            // $table->boolean('status')->default(1);
            // $table->string('payment_method');
            // $table->unsignedBigInteger('address_id');
            // $table->string('order_total');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            // $table->foreign('address_id')->references('id')->on('addresses')->onDelete('cascade');
            // Address Columns
            $table->string('name');
            $table->string('email');
            $table->string('phone');
            $table->unsignedBigInteger('country_id');
            $table->foreign('country_id')->references('id')->on('countries')->onDelete('cascade');
            $table->string('address');
            $table->string('apartment')->nullable();
            $table->string('city');
            $table->string('region');
            $table->string('zip');
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shop_orders');
    }
};