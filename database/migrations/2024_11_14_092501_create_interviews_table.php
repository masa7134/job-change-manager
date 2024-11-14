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
        Schema::create('interviews', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('application_id')->constrained('applications')->onDelete('cascade');
            $table->enum('preparation_status', ['未対策', '対策済'])->default('未対策');
            $table->enum('round', [0, 1, 2, 3, 4])->nullable();
            $table->text('content')->nullable();
            $table->date('date')->nullable();
            $table->enum('status', ['予定日', '実施済'])->default('予定日');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('interviews');
    }
};
