<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  public function up()
  {
    Schema::create('voyages', function (Blueprint $table) {
      $table->id();
      $table->date('date_voyage')->nullable();
      $table->time('heure')->nullable();
      $table->integer('nbr_places')->nullable();
      $table->string('lieu_depart')->nullable();
      $table->string('lieu_arrive')->nullable();
      $table->decimal('prix', 8, 2)->nullable();
      $table->string('telephone')->nullable();
      $table->unsignedBigInteger('user_id')->nullable(); // <-- Here is the user_id column
      $table->timestamps();
    });
  }

  public function down()
  {
    Schema::dropIfExists('voyages');
  }
};
