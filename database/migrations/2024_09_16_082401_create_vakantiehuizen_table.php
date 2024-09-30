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
        Schema::create('vakantiehuizen', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('naam');

            $table->string('locatie');
            $table->decimal('prijs', 10, 2);
            $table->integer('slaapkamers');
            $table->boolean('wifi')->default(false);
            $table->boolean('zwembad')->default(false);
            $table->boolean('spa')->default(false);
            $table->boolean('speeltuin')->default(false);
            $table->json('fotos')->nullable();
            $table->boolean('beschikbaarheid')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vakantiehuizen');
    }
};
