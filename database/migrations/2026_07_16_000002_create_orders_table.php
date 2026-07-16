<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->string('reference')->unique();
            $table->string('game_slug')->index();
            $table->string('game_name');
            $table->string('package_name');
            $table->unsignedInteger('amount');
            $table->string('player_id');
            $table->string('payment_method', 30)->index();
            $table->string('payer_number', 30)->nullable();
            $table->string('transaction_id', 50)->nullable()->index();
            $table->string('status', 30)->default('pending')->index();
            $table->text('admin_note')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
