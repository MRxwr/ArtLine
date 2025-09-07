<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('vouchers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('store_id')->nullable()->constrained()->onDelete('cascade');
            $table->string('code')->unique();
            $table->date('start_date');
            $table->date('end_date');
            $table->integer('usage_limit_total')->nullable();
            $table->integer('usage_limit_per_user')->nullable();
            $table->decimal('discount_amount', 12, 2);
            $table->enum('discount_type', ['FIXED', 'PERCENT']);
            $table->enum('applies_to', ['CART_TOTAL', 'SELECTED_ITEMS', 'SELECTED_ITEMS_DOUBLE']);
            $table->boolean('active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('vouchers');
    }
};
