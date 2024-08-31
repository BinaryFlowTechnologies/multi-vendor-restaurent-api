<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up (): void
  {
	Schema::create('items', function(Blueprint $table) {
	  $table->id();
	  $table->foreignId('restaurant_id')->constrained('restaurants');
	  $table->foreignId('category_id')->constrained('categories');
	  $table->string('name');
	  $table->integer('price')->default(0);
	  $table->integer('sort')->default(0);
	  $table->integer('free_addon')->default(0);
	  $table->longText('description')->nullable();
	  $table->boolean('status')->default(true);
	  $table->timestamps();
	});
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down ()
  {
	Schema::dropIfExists('items');
  }
}
