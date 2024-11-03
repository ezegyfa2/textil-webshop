<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('combined_color_colors', function (Blueprint $table) {
            $table->id();
            $table->foreignId('combined_color_id')->constrained('combined_colors');
            $table->foreignId('color_id')->constrained('colors');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('combined_color_colors');
    }
};
