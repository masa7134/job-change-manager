<?php

use App\Http\Controllers\CompanyController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth', 'verified')->group(function () {
    // ダッシュボード（進行中の企業一覧画面）
    Route::get('/dashboard', [CompanyController::class, 'index'])->name('dashboard');
    //企業登録画面
    Route::get('/companies/register', [CompanyController::class, 'create'])->name('companies.register');
    //企業保存ルート
    Route::post('/companies', [CompanyController::class, 'store'])->name('companies.store');
    //全企業表示
    Route::get('/companies/all', [CompanyController::class, 'allCompanies'])->name('companies.all');
    //企業詳細画面
    Route::get('/companies/{company}', [CompanyController::class, 'show'])->name('companies.show');
    // プロフィール関連のルート
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// // 外部APIリクエストを送信してデータを取得する処理
// Route::get('companies/fetch/{query}', [CompanyController::class, 'fetchCompanyDataFromApi'])->name('companies.fetch');

// // 企業リソースに対するルーティング
// Route::resource('companies', CompanyController::class);

require __DIR__.'/auth.php';
