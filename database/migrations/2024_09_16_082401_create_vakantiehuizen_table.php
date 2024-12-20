<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('vakantiehuizen', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('naam');
            $table->decimal('prijs', 10, 2);
            $table->text('beschrijving')->nullable();
            $table->integer('slaapkamers');
            $table->string('stad');
            $table->string('straatnaam');
            $table->string('postcode');
            $table->string('huisnummer');
            $table->decimal('latitude', 10, 7)->default(0);
            $table->decimal('longitude', 10, 7)->default(0);
            $table->boolean('wifi')->default(false);
            $table->boolean('zwembad')->default(false);
            $table->boolean('parkeren')->default(false);
            $table->boolean('speeltuin')->default(false);
            $table->boolean('beschikbaarheid')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('vakantiehuizen');
    }
};
