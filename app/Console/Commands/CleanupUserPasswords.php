<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class CleanupUserPasswords extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:cleanup-user-passwords';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $users = User::whereNull('password')->get();
        foreach ($users as $user) {
            // Google認証ユーザーのパスワードはnullのまま
            if (!$user->google_id) {
                // 通常ユーザーには仮パスワードを設定
                $user->password = Hash::make('temporary_password');
                $user->save();
            }
        }
    }
}
