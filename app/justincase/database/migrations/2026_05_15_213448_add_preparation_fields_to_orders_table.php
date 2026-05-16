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
        Schema::table('orders', function (Blueprint $table) {
            //
            $table->timestamp('preparation_started_at')->nullable();
            $table->timestamp('ready_at')->nullable();
            $table->unsignedInteger('estimated_preparation_time')->nullable();
            $table->unsignedInteger('actual_preparation_time')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn([
                'preparation_started_at',
                'ready_at',
                'estimated_preparation_time',
                'actual_preparation_time',
            ]);
        });
    }
};
