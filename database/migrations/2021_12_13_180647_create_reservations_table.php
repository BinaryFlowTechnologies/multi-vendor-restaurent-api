<?php

use App\Models\Reservation;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() : void
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')->nullable()->constrained('users');

            $table->string('name');
            $table->string('phone');
            $table->integer('person');
            $table->string('email');
            $table->dateTime('datetime')->comment('Booked for date');
            $table->text('note')->nullable();
            $table->string('found_on', 50)->nullable();
            $table->integer('status')->default(Reservation::STATUS_PENDING);
            $table->boolean('last_email_send_status')->default(true)
                ->comment('Last email send success/fail status');

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
        Schema::dropIfExists('reservations');
    }
}
