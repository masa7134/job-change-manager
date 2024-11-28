<?php

use App\Http\Controllers\CompanyController;
use App\Http\Controllers\InterviewController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth', 'verified')->group(function () {
    // ダッシュボード（進行中の企業一覧画面）
    Route::get('/dashboard', [CompanyController::class, 'index'])->name('dashboard');
    //企業登録画面
    Route::get('/company/register', [CompanyController::class, 'create'])->name('company.register');
    //企業保存ルート
    Route::post('/company', [CompanyController::class, 'store'])->name('company.store');
    //全企業表示
    Route::get('/company/all', [CompanyController::class, 'getAllCompanies'])->name('company.all');
    //企業詳細画面
    Route::get('/company/{company}', [CompanyController::class, 'show'])->name('company.show');
    //面接詳細画面
    Route::get('/interview/{interview}', [InterviewController::class, 'show'])->name('interview.show');
    //企業削除
    Route::delete('/company/{company}', [CompanyController::class, 'destroy'])->name('company.destroy');
    //企業更新
    Route::patch('/company/{company}', [CompanyController::class, 'update'])->name('company.update');
    // プロフィール関連のルート
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// // 外部APIリクエストを送信してデータを取得する処理
// Route::get('company/fetch/{query}', [CompanyController::class, 'fetchCompanyDataFromApi'])->name('company.fetch');

// // 企業リソースに対するルーティング
// Route::resource('company', CompanyController::class);

require __DIR__.'/auth.php';
