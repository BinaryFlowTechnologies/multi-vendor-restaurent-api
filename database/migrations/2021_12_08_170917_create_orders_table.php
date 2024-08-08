<?php

use App\Models\Order;
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
    public function up() : void
    {
        Schema::create('orders', function (Blueprint $table) {

            $table->id();
            $table->foreignId('user_id')->constrained('users');

            $table->foreignId('restaurant_id')->constrained('restaurants');

            // Total
            $table->integer('order_type')->default(Order::TYPE_COLLECTION);
            $table->integer('subtotal');
            $table->integer('delivery_charge')->nullable();
            $table->integer('discount')->nullable();
            $table->string('coupon_code')->nullable();
            $table->integer('coupon_amount')->default(0);
            $table->integer('total');

            // customer info
            $table->string('customer_name');
            $table->string('customer_phone');
            $table->string('customer_email');
            $table->string('house_no')->nullable();
            $table->string('street_name')->nullable();
            $table->string('city')->nullable();
            $table->string('county')->nullable();
            $table->string('postcode')->nullable();

            // Order info
            $table->text('note')->nullable()->comment('order instruction');
            $table->integer('status')->default(Order::STATUS_PENDING);
            $table->boolean('payment_status')->default(false);
            $table->boolean('print_status')->default(false);
            $table->boolean('notification_status')->default(false);
            $table->boolean('email_status')->default(false);

            // payment information
            $table->string('transaction_id')->nullable();
            $table->integer('payment_method')->default(Order::PAYMENT_TYPE_CASH);

            // Misc Information
            $table->dateTime('requested_delivery_time')->nullable()->comment('asked delivery time');
            $table->boolean('requested_time_is_asap')->nullable()->default(false)->comment('is requested for ASAP');
            $table->dateTime('accepted_delivery_time')->nullable()->comment('accepted delivery time');
            $table->dateTime('delivery_time')->nullable()->comment('delivered time');
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
