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
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('name', 100);
            $table->string('url')->nullable();
            $table->string('address')->nullable();
            $table->string('phone_number', 20)->nullable();
            $table->string('email', 100)->nullable();
            $table->text('corporate_philosophy')->nullable();
            $table->text('ceo_message')->nullable();
            $table->string('salary', 50)->nullable();
            $table->string('job_type', 100)->nullable();
            $table->string('work_hours', 50)->nullable();
            $table->string('work_location')->nullable();
            $table->text('first_assignment')->nullable();
            $table->tinyInteger('status')->default(0);// Status Enumの保存用
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('companies');
    }
};
