<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Application;
use App\Models\Interview;

class InterviewSeeder extends Seeder
{
    public function run(): void
    {
        $applications = Application::all();

        foreach($applications as $application) {
            Interview::create([
                'application_id' => $application->id,
                'interview_round' => 0,
                'interview_status' => 0,
                'preparation_status' => 0,
                'content' => null,
                'interview_date' => null,
            ]);
        }
    }
}
