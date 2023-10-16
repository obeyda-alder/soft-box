<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('site_footer', function (Blueprint $table) {
      $table->id();
      $table->string('locale')->index();
      $table->string('copy_right');
      $table->string('phone_number', 100)->nullable()->default(null);
      $table->string('working_hours')->nullable();
      $table->string('address')->nullable();
      $table->string('email')->nullable();
      $table->unique('locale');
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
    Schema::dropIfExists('site_footer');
  }
};
