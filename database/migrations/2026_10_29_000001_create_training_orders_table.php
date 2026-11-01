<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('training_orders', function (Blueprint $table) {
            $table->id();
            $table->string('name', 120);
            $table->string('email', 190)->index();
            $table->string('phone', 40);
            $table->string('course', 190);
            $table->string('training_option', 190);
            $table->unsignedInteger('amount_cents');
            $table->string('currency', 3)->default('usd');
            $table->string('status', 32)->default('pending')->index();
            $table->string('stripe_checkout_session_id')->nullable()->unique();
            $table->string('stripe_payment_intent_id')->nullable();
            $table->text('message')->nullable();
            $table->timestamp('paid_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('training_orders');
    }
};
