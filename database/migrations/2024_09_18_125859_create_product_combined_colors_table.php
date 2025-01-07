<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('product_combined_colors', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained('products')->cascadeOnDelete();
            $table->foreignId('combined_color_id')->constrained('combined_colors');
            $table->timestamps();

            $table->unique([
                'product_id',
                'combined_color_id',
            ]);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('product_combined_colors');
    }
};
