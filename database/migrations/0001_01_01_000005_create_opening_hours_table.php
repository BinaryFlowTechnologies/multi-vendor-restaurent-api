<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up (): void
    {
        Schema::create('opening_hours', function(Blueprint $table) {
            $table->id();
            $table->foreignId('day_id')->constrained('opening_days');
            $table->foreignId('restaurant_id')->constrained('restaurants');
            $table->time('pickup_from')->nullable();
            $table->time('pickup_to')->nullable();
            $table->time('delivery_from')->nullable();
            $table->time('delivery_to')->nullable();
            $table->boolean('delivery_enabled')->nullable()->default(true);
            $table->boolean('pickup_enabled')->nullable()->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down (): void
    {
        Schema::dropIfExists('opening_hours');
    }
};
