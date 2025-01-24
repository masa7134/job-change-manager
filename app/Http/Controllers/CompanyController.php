<?php

namespace App\Http\Controllers;

use App\Enums\Status;
use App\Enums\ApplicationStatus;
use App\Enums\EntryFormStatus;
use App\Enums\InterviewStatus;
use App\Enums\ResumeStatus;
use App\Enums\WorkHistoryStatus;
use App\Models\Company;
use App\Models\Application;
use App\Models\Interview;
use App\Http\Requests\CompanyRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CompanyController extends Controller
{
    // 企業一覧表示
    public function index()
    {
        $companies = Company::where('user_id', Auth::id())
            ->sortByProgress()
            // Eager Loadingし、コールバック関数でinterviewsの絞り込み
            ->with(['application.interviews' => function($query) {
                // 未来の予定面接を優先して取得
                $query->where(function($q) {
                    $q->where('interview_status', InterviewStatus::Schedule)
                        ->where('interview_datetime', '>=', now()->format('Y-m-d'));
                })
                //　予定面接がない場合は実施済みの最新を取得
                ->orWhere(function($q) {
                    $q->where('interview_status', InterviewStatus::Implemented);
                })
                // ステータスの優先順位を指定
                ->orderByRaw("FIELD(interview_status, ?, ?) ASC", [
                    InterviewStatus::Schedule,
                    InterviewStatus::Implemented,
                ])
                ->orderBy('interview_datetime', 'asc')// 面接日が近い順で表示
                ->take(1);// １件のみ取得
            }])
            ->paginate(20);

        return view('dashboard', compact('companies'));
    }

    // 新規企業作成フォーム表示
    public function create()
    {
        return view('company.create');
    }

    // 企業データ保存
    public function store(CompanyRequest $request)
    {
        // 企業名とURLが一致する企業が既に存在するかチェック
        $existingCompany = Company::where([
            'user_id' => Auth::id(),
            'name' => $request->name,
            'url' => $request->url,
        ])->first();

        // 既に同じ企業が登録されていた場合は企業詳細画面に遷移しエラーを返す
        if ($existingCompany) {
            return redirect()
                ->route('company.edit', $existingCompany->id)
                ->with('warning', '既に同じ企業が登録されています。');
        }

        $company = Company::create([
            'name' => $request->name,
            'url' => $request->url,
            'user_id' => Auth::id(),
        ]);

        // アプリケーション関連データも同時に作成しcompanyに関連づけ
        $company->application()->create();

        return redirect()->route('company.register')->with('success', '企業情報が登録されました。');
    }

    // 企業編集フォーム表示
    public function edit(int $id)
    {
        $company = Company::where('id', $id)
        ->with('application.interviews')
        ->firstOrFail();

        $company->application()->create([
            'resume_status' => ResumeStatus::NotCreated,
            'work_history_status' => WorkHistoryStatus::NotCreated,
            'entry_form_status' => EntryFormStatus::NotEntered,
            'application_status' => ApplicationStatus::NotSubmitted,
        ]);

        $company->load('application.interviews');//常に最新の状態をロード

        $statuses = Company::getStatuses();
        $applicationStatuses = Application::getStatuses();
        $interviewStatuses = Interview::getStatuses();
        $interviews = $company->application->interviews;

        return view('company.edit', compact('company', 'statuses', 'applicationStatuses', 'interviewStatuses', 'interviews'));
    }

    // 企業情報更新
    public function update(CompanyRequest $request, int $id)
    {
        $company = Company::findOrFail($id);
        $company->update($request->validated());

        if ($company->application) {
            $company->application->update([
                'resume_status' => $request->resume_status,
                'work_history_status' => $request->work_history_status,
                'entry_form_status' => $request->entry_form_status,
                'application_status' => $request->application_status,
            ]);
        }

        return redirect()->route('company.edit', $company->id)->with('success', '企業情報が更新されました。');
    }

    // 企業削除
    public function destroy(int $id)
    {
        $company = Company::findOrFail($id);
        $company->delete();

        return redirect()->route('dashboard')->with('success', '企業情報が削除されました。');
    }

    // すべての企業を表示（フィルター機能付き）
    public function getAllCompanies(Request $request)
    {
        // 全企業取得するクエリ
        $query = Company::where('user_id', Auth::id())
            ->with('application.interviews');

        // status_filterパラメーターが存在したらフィルタリング、存在しなければ全件表示
        $currentFilter = $request->get('status_filter', Status::All);
        if ($currentFilter != Status::All) {
            $query->where('status', $currentFilter);
        }

        // クエリを実行
        $companies = $query->orderBy('updated_at', 'desc')->get();
        $statuses = Company::getStatuses();

        return view('company.all', compact('companies', 'statuses', 'currentFilter'));
    }
}
