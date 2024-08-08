<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddonGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() : void
    {
        Schema::create('addon_groups', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description')->nullable();
            $table->integer('price')->default(0);
            $table->integer('sort')->default(0);
            $table->boolean('status')->default(0);
            $table->timestamps();
        });

        Schema::create('addon_group_item', function(Blueprint $table){
            $table->id();

            $table->foreignId('addon_group_id')
                ->constrained('addon_groups')
            ;

            $table->foreignId('item_id')
                ->constrained('items')
            ;

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
        Schema::dropIfExists('addon_groups');
        Schema::dropIfExists('addon_group_item');
    }
}
