<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Http\Requests\CompanyRequest; // バリデーション用のリクエストクラス（後述）
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    //企業一覧表示
    public function index()
    {
        $companies = Company::all();
        return view('companies.index', compact('companies'));
    }

    //新規企業作成フォーム表示
    public function create()
    {
        return view('companies.create');
    }

    //企業データ保存
    public function store(CompanyRequest $request)
    {
        $company = Company::create($request->validated());

        return redirect()->route('companies.index')->with('success', '企業情報が登録されました。');
    }

    //企業詳細表示
    public function show(int $id)
    {
        $company = Company::findOrFail($id);
        return view('companies.show', compact('company'));
    }

    //企業編集フォーム表示
    public function edit(int $id)
    {
        $company = Company::findOrFail($id);
        return view('companies.edit', compact('company'));
    }

    //企業情報更新
    public function update(CompanyRequest $request, int $id)
    {
        $company = Company::findOrFail($id);
        $company->update($request->validated());

        return redirect()->route('companies.index')->with('success', '企業情報が更新されました。');
    }

    //企業削除
    public function destroy(int $id)
    {
        $company = Company::findOrFail($id);
        $company->delete();

        return redirect()->route('companies.index')->with('success', '企業情報が削除されました。');
    }

    //外部APIリクエストを送信してデータを取得する処理
    public function fetchCompanyDataFromApi(string $query)
    {
        // APIエンドポイント（例: 国税庁法人番号API）
        
    }
}
