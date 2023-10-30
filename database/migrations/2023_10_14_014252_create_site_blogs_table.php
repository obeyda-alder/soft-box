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
    Schema::create('site_blogs', function (Blueprint $table) {
      $table->id();
      $table->string('locale')->index();
      $table->string('title');
      $table->string('slug')->unique();
      $table->text('content');
      $table->text('excerpt')->nullable();
      $table->string('author');
      $table->timestamp('published_at')->nullable();
      $table->enum('status', ['active', 'unactive'])->default('active');
      $table->integer('views')->default(0);
      $table->integer('likes')->default(0);
      $table->string('logo')->nullable();
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
    Schema::dropIfExists('site_blogs');
  }
};
