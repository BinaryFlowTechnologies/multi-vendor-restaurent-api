<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() : void
    {
        Schema::create('addons', function (Blueprint $table) {
            $table->id();

            $table->foreignId('addon_group_id')
                ->constrained('addon_groups')
            ;

            $table->foreignId('restaurant_id')
                ->constrained('restaurants')
            ;

            $table->string('name');
            $table->integer('price')->default(0);
            $table->integer('type')->nullable()->default(1);
            $table->integer('sort')->nullable()->default(0);
            $table->boolean('status')->nullable()->default(1);
            $table->boolean('available_for_free')->nullable()->default(1);
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
        Schema::dropIfExists('addons');
    }
}
