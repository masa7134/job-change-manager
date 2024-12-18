<?php

namespace Database\Seeders;

use App\Models\Application;
use App\Enums\ResumeStatus;
use App\Enums\WorkHistoryStatus;
use App\Enums\EntryFormStatus;
use App\Enums\ApplicationStatus;
use Illuminate\Database\Seeder;

class ApplicationSeeder extends Seeder
{
    public function run(): void
    {
        // 1. テックスター（0,0,0,0）
        Application::create([
            'company_id' => 1,
            'resume_status' => ResumeStatus::NotCreated,
            'work_history_status' => WorkHistoryStatus::NotCreated,
            'entry_form_status' => EntryFormStatus::NotEntered,
            'application_status' => ApplicationStatus::NotSubmitted,
        ]);

        // 2. フューチャーシステム（1,0,0,0）
        Application::create([
            'company_id' => 2,
            'resume_status' => ResumeStatus::Created,
            'work_history_status' => WorkHistoryStatus::NotCreated,
            'entry_form_status' => EntryFormStatus::NotEntered,
            'application_status' => ApplicationStatus::NotSubmitted,
        ]);

        // 3. グローバルソフト（1,1,0,0）
        Application::create([
            'company_id' => 3,
            'resume_status' => ResumeStatus::Created,
            'work_history_status' => WorkHistoryStatus::Created,
            'entry_form_status' => EntryFormStatus::NotEntered,
            'application_status' => ApplicationStatus::NotSubmitted,
        ]);

        // 4. デジタルコア（1,1,0,0）
        Application::create([
            'company_id' => 4,
            'resume_status' => ResumeStatus::Created,
            'work_history_status' => WorkHistoryStatus::Created,
            'entry_form_status' => EntryFormStatus::NotEntered,
            'application_status' => ApplicationStatus::NotSubmitted,
        ]);

        // 5. ネクストイノベーション（1,1,1,1）- 面接進行中
        Application::create([
            'company_id' => 5,
            'resume_status' => ResumeStatus::Created,
            'work_history_status' => WorkHistoryStatus::Created,
            'entry_form_status' => EntryFormStatus::Entered,
            'application_status' => ApplicationStatus::Submitted,
        ]);

        // 6. サイバーフロント（1,1,1,1）- 面接進行中
        Application::create([
            'company_id' => 6,
            'resume_status' => ResumeStatus::Created,
            'work_history_status' => WorkHistoryStatus::Created,
            'entry_form_status' => EntryFormStatus::Entered,
            'application_status' => ApplicationStatus::Submitted,
        ]);

        // 7. クラウドテクノロジー（1,1,1,1）- 不採用
        Application::create([
            'company_id' => 7,
            'resume_status' => ResumeStatus::Created,
            'work_history_status' => WorkHistoryStatus::Created,
            'entry_form_status' => EntryFormStatus::Entered,
            'application_status' => ApplicationStatus::Submitted,
        ]);

        // 8. AIソリューション（1,1,1,1）- 内定
        Application::create([
            'company_id' => 8,
            'resume_status' => ResumeStatus::Created,
            'work_history_status' => WorkHistoryStatus::Created,
            'entry_form_status' => EntryFormStatus::Entered,
            'application_status' => ApplicationStatus::Submitted,
        ]);
    }
}
