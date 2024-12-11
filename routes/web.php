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
    // 企業登録
    Route::get('/company/register', [CompanyController::class, 'create'])->name('company.register');
    Route::post('/company', [CompanyController::class, 'store'])->name('company.store');
    // 全企業表示
    Route::get('/company/all', [CompanyController::class, 'getAllCompanies'])->name('company.all');
    // 企業詳細画面
    Route::get('/company/{company}/edit', [CompanyController::class, 'edit'])->name('company.edit');
    // 企業保存ルート
    Route::post('/company', [CompanyController::class, 'store'])->name('company.store');
    // 企業更新
    Route::post('/company/{company}', [CompanyController::class, 'update'])->name('company.update');
    // 企業削除
    Route::delete('/company/{company}', [CompanyController::class, 'destroy'])->name('company.destroy');
    // 面接作成
    Route::get('/interview/create', [InterviewController::class, 'create'])->name('interview.create');
    Route::post('/interview', [InterviewController::class, 'store'])->name('interview.store');
    // 面接詳細画面
    Route::get('/interview/{interview}/edit', [InterviewController::class, 'edit'])->name('interview.edit');
    // 面接更新
    Route::post('/interview/{interview}/', [InterviewController::class, 'update'])->name('interview.update');
    // 面接削除
    Route::delete('/interview/{interview}', [InterviewController::class, 'destroy'])->name('interview.destroy');
    // プロフィール関連のルート
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
