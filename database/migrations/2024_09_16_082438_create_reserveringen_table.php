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
        Schema::create('reserveringen', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vakantiehuis_id')->constrained('vakantiehuizen')->onDelete('cascade');
            $table->foreignId('huurder_id')->constrained('users')->onDelete('cascade');
            $table->string('reserveringsnummer')->unique();
            $table->date('begindatum');
            $table->date('einddatum');
            $table->enum('status', ['bevestigd', 'in_afwachting', 'geannuleerd'])->default('in_afwachting');
            $table->timestamps();
        });


        Schema::table('reserveringen', function (Blueprint $table) {

            $table->foreign('huurder_id')
                ->references('user_id')
                ->on('role_user_verhuurder_huurder_admin')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reserveringen');
    }
};
