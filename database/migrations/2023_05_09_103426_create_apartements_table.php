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
        Schema::create('apartements', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('type');
            $table->string('wilaya');
            $table->string('commune');
            $table->string('photo');
            $table->string('descreption');
            $table->json('perks')->nullable();
            $table->string('extrainfo');
            $table->string('maxguests');
            $table->string('price');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('apartements');
    }
};
