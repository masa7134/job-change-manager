<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('interviews', function (Blueprint $table) {
            //新しいカラムを追加
            $table->dateTime('interview_datetime')->nullable()->after('interview_date');
        });
        
        // 既存データを新カラムに移行
        DB::statement('UPDATE interviews SET interview_datetime = interview_date');
        
        Schema::table('interviews', function (Blueprint $table) {
            // 古いカラムを削除
            $table->dropColumn('interview_date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('interviews', function (Blueprint $table) {
            // ロールバック時の処理
            $table->date('interview_date')->nullable()->after('interview_datetime');
        });

        // データを戻す
        DB::statement('UPDATE interviews SET interview_date = DATE(interview_datetime)');

        Schema::table('interviews', function (Blueprint $table) {
            // 新しいカラムを削除
            $table->dropColumn('interview_datetime');
        });
    }
};
