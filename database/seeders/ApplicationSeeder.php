<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Company;
use App\Models\Application;

class ApplicationSeeder extends Seeder
{
    public function run(): void
    {
        $companies = Company::all();

        foreach($companies as $company) {
            Application::create([
                'company_id' => $company->id,
                'resume_status' => 0,
                'work_history_status' => 0,
                'entry_form_status' => 0,
                'application_status' => 0,
            ]);
        }
    }
}
