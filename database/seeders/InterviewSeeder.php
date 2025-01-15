<?php

namespace Database\Seeders;

use App\Models\Interview;
use App\Enums\InterviewStatus;
use App\Enums\InterviewRound;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class InterviewSeeder extends Seeder
{
    public function run(): void
    {
        // ネクストイノベーション（会社ID: 5）
        // パターン1: 1次面接が予定
        Interview::create([
            'application_id' => 5,
            'interview_round' => InterviewRound::First,
            'interview_status' => InterviewStatus::Schedule,
            'interview_datetime' => Carbon::now()->addDays(3),
            'preparation_status' => false,
            'content' => '一次面接の準備を進める',
        ]);

        // サイバーフロント（会社ID: 6）
        // パターン2: 1次面接実施済み、2次面接が予定
        Interview::create([
            'application_id' => 6,
            'interview_round' => InterviewRound::First,
            'interview_status' => InterviewStatus::Implemented,
            'interview_datetime' => Carbon::now()->subDays(3),
            'preparation_status' => true,
            'content' => '一次面接完了。良好な手応え。',
        ]);

        Interview::create([
            'application_id' => 6,
            'interview_round' => InterviewRound::Second,
            'interview_status' => InterviewStatus::Schedule,
            'interview_datetime' => Carbon::now()->addDays(7),
            'preparation_status' => false,
            'content' => '二次面接の準備を開始する',
        ]);

        // クラウドテクノロジー（会社ID: 7）- 不採用
        // パターン5: 1次面接実施済み（不採用）
        Interview::create([
            'application_id' => 7,
            'interview_round' => InterviewRound::First,
            'interview_status' => InterviewStatus::Implemented,
            'interview_datetime' => Carbon::now()->subDays(5),
            'preparation_status' => true,
            'content' => '一次面接実施。不採用。',
        ]);

        // AIソリューション（会社ID: 8）- 内定
        // パターン3: 1次、2次実施済み、3次予定
        Interview::create([
            'application_id' => 8,
            'interview_round' => InterviewRound::First,
            'interview_status' => InterviewStatus::Implemented,
            'interview_datetime' => Carbon::now()->subDays(10),
            'preparation_status' => true,
            'content' => '一次面接完了。好印象。',
        ]);

        Interview::create([
            'application_id' => 8,
            'interview_round' => InterviewRound::Second,
            'interview_status' => InterviewStatus::Implemented,
            'interview_datetime' => Carbon::now()->subDays(5),
            'preparation_status' => true,
            'content' => '二次面接完了。次は最終面接。',
        ]);

        Interview::create([
            'application_id' => 8,
            'interview_round' => InterviewRound::Third,
            'interview_status' => InterviewStatus::Schedule,
            'interview_datetime' => Carbon::now()->addDays(5),
            'preparation_status' => false,
            'content' => '最終面接の準備を進める',
        ]);
    }
}
