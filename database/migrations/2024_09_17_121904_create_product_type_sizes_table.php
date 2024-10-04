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
        Schema::create('product_type_sizes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('size_id')->constrained('sizes');
            $table->foreignId('product_type_id')->constrained('product_types');
            $table->string('name');
            $table->integer('value');
            $table->timestamps();

            $table->unique([
                'size_id',
                'product_type_id',
                'name',
            ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_sizes');
    }
};
