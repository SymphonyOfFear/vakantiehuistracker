<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('recensies', function (Blueprint $table) {
            $table->id();
            $table->foreignId('reservering_id')->constrained('reserveringen')->onDelete('cascade'); // Koppeling met reservering
            $table->foreignId('user_id')->constrained('users');
            $table->text('recensie'); // Tekst van de recensie
            $table->unsignedTinyInteger('beoordeling')->default(0); // Beoordeling op een schaal van 1-5
            $table->boolean('zichtbaar')->default(true); // Optie om de recensie te verbergen
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recensies');
    }
};
