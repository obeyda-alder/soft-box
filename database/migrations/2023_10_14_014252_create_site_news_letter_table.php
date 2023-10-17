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
    Schema::create('site_news_letter', function (Blueprint $table) {
      $table->id();
      $table->string('locale')->index();
      $table->string('small_title');
      $table->string('title');
      $table->text('description')->nullable();
      $table->string('manager_name');
      $table->string('info_manage');
      $table->text('description_of_the_manager')->nullable();
      $table->string('manager_logo', 200)->nullable()->default(null);
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
    Schema::dropIfExists('site_news_letter');
  }
};
