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
            $table->bigIncrements('id');
            $table->foreignId('user_id')->constrained('users')->onDelete(('cascade'));
            $table->string('name', 100);
            $table->string('url', 255);
            $table->string('address', 255)->nullable();
            $table->string('phone_number', 20)->nullable();
            $table->string('email', 100)->nullable();
            $table->text('corporate_philosophy')->nullable();
            $table->text('ceo_message')->nullable();
            $table->string('salary', 50)->nullable();
            $table->string('job_type', 100)->nullable();
            $table->string('work_hours', 50)->nullable();
            $table->string('work_location', 255)->nullable();
            $table->text('first_assignment')->nullable();
            $table->enum('status', ['進行中', '内定', '不採用'])->default('進行中');
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
