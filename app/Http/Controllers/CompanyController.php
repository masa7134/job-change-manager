<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Application;
use App\Models\Interview;
use App\Http\Requests\CompanyRequest; // バリデーション用のリクエストクラス（後述）
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    //企業一覧表示
    public function index()
    {
        $companies = Company::where('status', '進行中')
        ->where('user_id', auth()->id())
        ->get();

        return view('dashboard', compact('companies'));
    }

    //新規企業作成フォーム表示
    public function create()
    {
        return view('company.create');
    }

    //企業データ保存
    public function store(CompanyRequest $request)
    {
        $company = Company::create($request->validated());

        return redirect()->route('company.index')->with('success', '企業情報が登録されました。');
    }

    //企業詳細表示
    public function show($id)
    {
        $company = Company::findOrFail($id);

        return view('company.show', compact('company'));
    }

    //企業編集フォーム表示
    public function edit(int $id)
    {
        $company = Company::where('id', $id)
        ->with('application.interviews')
        ->firstOrFail();

        $statuses = Company::getStatuses();
        $applicationStatuses = Application::getStatuses();
        $interviewStatuses = Interview::getStatuses();

        return view('company.edit', compact('company', 'statuses', 'applicationStatuses', 'interviewStatuses'));
    }

    //企業情報更新
    public function update(CompanyRequest $request, int $id)
    {
        $company = Company::findOrFail($id);
        $company->update(array_merge($request->validated(), [
            'status' => $request->status,
        ]));

        $application = $company->application;
        $application->update([
            'resume_status' => $request->resume_status,
            'work_history_status' => $request->work_history_status,
            'entry_form_status' => $request->entry_form_status,
            'application_status' => $request->application_status,
        ]);

        return redirect()->route('company.edit', $company->id)->with('success', '企業情報が更新されました。');
    }

    //企業削除
    public function destroy(int $id)
    {
        $company = Company::findOrFail($id);
        $company->delete();

        return redirect()->route('dashboard')->with('success', '企業情報が削除されました。');
    }

    //すべての企業を表示
    public function getAllCompanies()
    {
        $companies = Company::where('user_id', auth()->id())->get();

        return view('company.all', compact('companies'));
    }

    //外部APIリクエストを送信してデータを取得する処理
    public function fetchCompanyDataFromApi(string $query)
    {
        // APIエンドポイント（例: 国税庁法人番号API）

    }
}
