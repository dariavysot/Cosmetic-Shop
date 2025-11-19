<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('cosmetics', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('sku')->nullable();
            $table->text('description')->nullable();
            $table->decimal('price', 10, 2)->default(0);
            $table->foreignId('supplier_id')->nullable()->constrained('suppliers')->nullOnDelete();
            $table->timestamps();
        });

        // Індекси для пошуку
        Schema::table('cosmetics', function (Blueprint $table) {
            $table->index('name');
            $table->index('supplier_id');
        });
    }

    public function down(): void {
        Schema::dropIfExists('cosmetics');
    }
};
