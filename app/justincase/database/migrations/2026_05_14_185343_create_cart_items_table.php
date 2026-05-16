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
        Schema::create('cart_items', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();

            $table->foreignId('cart_id')->constrained()->cascadeOnDelete();

            $table->foreignId('menu_item_id')->constrained('menu_items')->cascadeOnDelete();

            $table->foreignId('menu_item_variant_id')->nullable()->constrained('menu_item_variants')->nullOnDelete();

            $table->unsignedInteger('quantity')->default(1);

            $table->decimal('unit_price', 10, 2);

            $table->decimal('total_price', 10, 2);

            $table->text('special_instructions')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cart_items');
    }
};
