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
    Schema::create('site_navbars', function (Blueprint $table) {
      $table->id();
      $table->string('logo', 200)->nullable()->default(null);
      $table->string('locale')->index();
      $table->string('key_contact');
      $table->string('phone_number', 100)->nullable()->default(null);
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
    Schema::dropIfExists('site_navbars');
  }
};
