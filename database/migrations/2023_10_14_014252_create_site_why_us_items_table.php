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
    Schema::create('site_why_us_items', function (Blueprint $table) {
      $table->id();
      $table->string('locale')->index();
      $table->string('title');
      $table->text('description')->nullable();
      $table->integer('box_number')->nullable();
      $table->enum('type', ['BOX', 'ITEM'])->default('BOX')->comment('BOX | ITEM ');
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
    Schema::dropIfExists('site_why_us_items');
  }
};
