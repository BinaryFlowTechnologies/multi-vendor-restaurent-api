<?php

use App\Models\UserAddress;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserAddressesTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up (): void
  {
	Schema::create('user_addresses', function(Blueprint $table) {
	  $table->id();
	  $table->foreignId('user_id')->constrained('users');

	  $table->integer('type')->default(UserAddress::TYPE_HOME);
	  $table->string('house_no');
	  $table->string('street_name');
	  $table->string('city');
	  $table->string('county');
	  $table->string('postcode');
	  $table->string('long')->nullable()->default(null);
	  $table->string('lat')->nullable()->default(null);
	  $table->decimal('distance', 10, 4)->nullable()->default(null);
	  $table->string('note', 50)->nullable();
	  $table->boolean('is_default')->default('0');
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
	Schema::dropIfExists('user_addresses');
  }
}
