<?php

namespace App\Http\Controllers;

use App\Enums\InterviewStatus;
use App\Models\Interview;
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
    public function create(int $id)
    {
        $company = Company::where('id', $id)
            ->with('application.interviews')
            ->firstOrFail();

        $interviewStatuses = Interview::getStatuses();

        // すでに存在する面接ラウンドの番号を取得
        $existingRounds =$company->application->interviews->pluck('interview_round')->toArray();

        // 次の面接ラウンドを決定（最大ラウンド番号に1を加える）
        $nextRound = empty($existingRounds) ? 0 : min(max($existingRounds) + 1, 4);//4を超えない

        $interview = new Interview();
        $interview->application_id = $company->application->id;
        $interview->preparation_status = 0;// enumの初期値を設定
        $interview->interview_round = $nextRound;
        $interview->save();

        return redirect()->route('interview.edit', [
            'company' => $company->id,
            'interview' => $interview->id,
        ])->with('success', '面接情報が作成されました。');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
    public function edit(string $companyId, string $interviewId)
    {
        $company = Company::with('application')
            ->findOrFail($companyId);
        $interview = Interview::findOrFail($interviewId);
        $interviewStatuses = Interview::getStatuses();

        return view('interview.edit', compact(
            'interview',
            'interviewStatuses',
            'company',
        ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(InterviewRequest $request, $companyId, $interviewId)
    {
        $company = Company::findOrFail($companyId);
        $interview = Interview::findOrFail($interviewId);

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
    public function destroy(string $companyId, string $interviewId)
    {
        $interview = Interview::findOrFail($interviewId);
        $companyId = $interview->application->company->id;

        $interview->delete();

        return redirect()->route('company.edit', ['company' => $companyId])->with('success', '面接情報が削除されました。');
    }
}
