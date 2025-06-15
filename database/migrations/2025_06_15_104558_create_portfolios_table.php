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
        Schema::create('portfolios', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('stock_symbol', 10);
            $table->string('stock_name');
            $table->integer('quantity');
            $table->decimal('purchase_price', 10, 2);
            $table->decimal('current_price', 10, 2)->nullable();
            $table->date('purchase_date');
            $table->text('notes')->nullable();
            $table->timestamps();

            // Index for better performance on user queries
            $table->index('user_id');
            $table->index(['user_id', 'stock_symbol']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('portfolios');
    }
};
