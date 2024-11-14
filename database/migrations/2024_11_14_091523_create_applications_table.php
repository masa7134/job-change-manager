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
        Schema::create('applications', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('company_id')->constrained('companies')->onDelete('cascade');
            $table->enum('resume_status', ['未作成', '作成済'])->default('未作成');
            $table->enum('work_history_status', ['未作成', '作成済'])->default('未作成');
            $table->enum('entry_form_status', ['未入力', '入力済', '非該当'])->default('未入力');
            $table->enum('application_status', ['未提出', '提出済'])->default('未提出');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('applications');
    }
};
