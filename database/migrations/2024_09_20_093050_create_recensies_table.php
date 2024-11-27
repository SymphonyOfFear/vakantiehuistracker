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
            $table->unsignedBigInteger('vakantiehuis_id');
            $table->unsignedBigInteger('user_id');
            $table->integer('rating')->check('rating >= 1 AND rating <= 5');
            $table->text('comment');
            $table->timestamps();
        });
        // Schema::table('recensies', function (Blueprint $table) {
        //     $table->foreign('user_id')
        //         ->references('user_id')
        //         ->on('')
        //         ->where('role_id', function ($query) {
        //             $query->select('id')
        //                 ->from('roles')
        //                 ->where('name', 'huurder');
        //         });
        // });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recensies');
    }
};
