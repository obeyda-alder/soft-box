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
    Schema::create('site_portfolio_images', function (Blueprint $table) {
      $table->id();
      $table->string('locale')->index();
      $table->string('title');
      $table->text('description')->nullable();
      $table->string('tab_name', 50)->nullable()->default(null);
      $table->string('image')->nullable();
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
    Schema::dropIfExists('site_portfolio_images');
  }
};
