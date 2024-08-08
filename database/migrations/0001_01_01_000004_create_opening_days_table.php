<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up() : void
    {
        Schema::create('opening_days', function (Blueprint $table) {
            $table->id();
            $table->enum('day', ['sat', 'sun', 'mon', 'tue', 'wed', 'thu', 'fri'])->unique();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down() : void
    {
        Schema::dropIfExists('opening_days');
    }
};
