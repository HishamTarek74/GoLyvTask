<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('seats', function (Blueprint $table) {
            $table->id();
            $table->integer('seat_no')->unique();
            $table->boolean('is_available')->default(true);
            $table->foreignId('bus_id')->constrained();

            $table->bigInteger('start_station_id')->unsigned();
            $table->foreign('start_station_id')->references('id')->on('stations');

            $table->bigInteger('end_station_id')->unsigned();
            $table->foreign('end_station_id')->references('id')->on('stations');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('seats');
    }
};
