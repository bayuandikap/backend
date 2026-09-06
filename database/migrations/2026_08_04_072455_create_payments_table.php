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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();

            $table->foreignId('house_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('payment_type_id')
                ->constrained();

            $table->unsignedTinyInteger('month');
            $table->unsignedSmallInteger('year');

            $table->decimal('amount', 12, 2);

            $table->date('paid_at')->nullable();

            $table->enum('status', ['paid', 'unpaid'])
                ->default('unpaid');

            $table->text('notes')->nullable();

            $table->timestamps();

            // Composite unique index
            $table->unique(
                ['house_id', 'payment_type_id', 'month', 'year'],
                'payments_unique_monthly'
            );
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
