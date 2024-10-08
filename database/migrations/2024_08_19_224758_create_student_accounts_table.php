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
        Schema::create('student_accounts', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->string('type');
            $table->foreignId('student_id')->references('id')->on('students')->cascadeOnDelete();
            $table->foreignId('fee_invoice_id')->nullable()->references('id')->on('fee_invoices')->cascadeOnDelete();
            $table->foreignUuid('receipt_id')->nullable()->references('id')->on('receipt_students')->cascadeOnDelete();
            $table->foreignUuid('processing_id')->nullable()->references('id')->on('processing_fees')->cascadeOnDelete();
            $table->foreignUuid('payment_id')->nullable()->references('id')->on('payment_students')->cascadeOnDelete();
            $table->decimal('Debit', 8, 2)->nullable();
            $table->decimal('credit', 8, 2)->nullable();
            $table->string('description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_accounts');
    }
};
