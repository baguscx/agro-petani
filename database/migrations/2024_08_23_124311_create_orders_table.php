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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('set null');
            $table->foreignId('product_id')->nullable()->constrained('products')->onDelete('set null');
            $table->date('mulai')->nullable();
            $table->date('selesai')->nullable();
            $table->string('lokasi')->nullable();
            $table->string('telepon')->nullable();
            $table->string('catatan')->nullable();
            $table->string('jumlah')->nullable();
            $table->string('total')->nullable();
            $table->enum('status', ['paid', 'unpaid'])->nullable();
            $table->string('snap_token')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
