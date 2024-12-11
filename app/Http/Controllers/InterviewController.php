<?php

namespace App\Http\Controllers;

use App\Enums\InterviewRound;
use App\Enums\InterviewStatus;
use App\Enums\PreparationStatus;
use App\Models\Interview;
use App\Models\Application;
use App\Models\Company;
use App\Http\Requests\InterviewRequest;
use Illuminate\Http\Request;

class InterviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $companyId = $request->input('company_id');
        $company = Company::findOrFail($companyId);
        $application = $company->application;

        if ($request->has('interview_round')) {
            //文字列を整数に変換してからEnumを生成
            $roundValue = (int) $request->input('interview_round');
            $interviewRound = InterviewRound::fromValue($roundValue);
        } else {
            $latestInterview = $application->interviews()->latest('interview_round')->first();
            $interviewRound = $latestInterview
                ? InterviewRound::fromValue($latestInterview->interview_round)->nextRound()
                : InterviewRound::Casual;
        }

        $interviewStatuses = Interview::getStatuses();

        // 新規面接レコードを作成（まだDBには保存しない！）
        $interview = new Interview([
            'company_id' => $companyId,
            'application_id' => $application->id,
            'interview_round' => $interviewRound->value,
            'interview_status' => InterviewStatus::Schedule,
            'preparation_status' => PreparationStatus::NoCountermeasures,
        ]);

        return view('interview.create', compact(
            'company',
            'interview',
            'interviewRound',
            'interviewStatuses',
        ));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(InterviewRequest $request)
    {
        $validated = $request->validated();

        //interview_roundがnullでないことを確認
        if (is_null($validated['interview_round'])) {
            return redirect()->back()->withInput()->withErrors(['interview_round' => '面接ラウンドは必須です']);
        }

        $companyId = $request->input('company_id');
        $company = Company::findOrFail($companyId);
        $application = $company->application;

        $interview = $application->interviews()->create($validated);
        $interviewStatuses = Interview::getStatuses();

        return redirect()->route('interview.edit', compact(
            'company',
            'interview',
            'interviewStatuses',
        ))->with('success', '面接情報を登録しました');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $interviewId)
    {
        $interview = Interview::with('application.company')->findOrFail($interviewId);
        $interviewStatuses = Interview::getStatuses();

        $company = $interview->application->company;

        return view('interview.edit', compact(
            'interview',
            'interviewStatuses',
            'company',
        ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(InterviewRequest $request, $interviewId)
    {
        $interview = Interview::with('application.company')
            ->findOrFail($interviewId);

        $company = $interview->application->company;

        $interview->update([
            'interview_date' => $request->interview_date,
            'interview_status' => $request->interview_status,
            'preparation_status' => $request->preparation_status,
            'content' => $request->content,
        ]);

        return redirect()->route('interview.edit', ['company' => $company->id, 'interview' => $interview->id])->with('success', '面接情報が更新されました。');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $interviewId)
    {
        $interview = Interview::findOrFail($interviewId);
        $companyId = $interview->application->company->id;

        $interview->delete();

        return redirect()->route('company.edit', ['company' => $companyId])->with('success', '面接情報が削除されました。');
    }
}
