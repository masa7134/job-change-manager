<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Enums\Status;
use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    public function run(): void
    {
        // 進行中の企業（応募ステップ進行中）
        Company::create([
            'user_id' => 1,
            'name' => 'テックスター株式会社',
            'url' => 'https://www.techstar.co.jp',
            'address' => '東京都渋谷区神宮前1-1-1',
            'phone_number' => '03-1234-5678',
            'email' => 'recruit@techstar.co.jp',
            'corporate_philosophy' => '技術で未来を創造する',
            'ceo_message' => '常に革新を追求します',
            'salary' => '年収400-600万円',
            'job_type' => 'Webエンジニア',
            'work_hours' => 'フレックスタイム制',
            'work_location' => '東京都渋谷区',
            'first_assignment' => 'Webアプリケーション開発',
            'status' => Status::InProgress,
        ]);

        Company::create([
            'user_id' => 1,
            'name' => 'フューチャーシステム株式会社',
            'url' => 'https://www.future-sys.co.jp',
            'address' => '東京都港区六本木2-2-2',
            'phone_number' => '03-2345-6789',
            'email' => 'recruit@future-sys.co.jp',
            'corporate_philosophy' => '次世代システムの創造',
            'ceo_message' => '技術革新で社会に貢献',
            'salary' => '年収450-700万円',
            'job_type' => 'システムエンジニア',
            'work_hours' => '9:00-18:00',
            'work_location' => '東京都港区',
            'first_assignment' => 'システム開発プロジェクト',
            'status' => Status::InProgress,
        ]);

        Company::create([
            'user_id' => 1,
            'name' => 'グローバルソフト株式会社',
            'url' => 'https://www.globalsoft.co.jp',
            'address' => '東京都新宿区新宿3-3-3',
            'phone_number' => '03-3456-7890',
            'email' => 'recruit@globalsoft.co.jp',
            'corporate_philosophy' => 'グローバルな価値創造',
            'ceo_message' => '世界に通用する技術を',
            'salary' => '年収500-800万円',
            'job_type' => 'ソフトウェアエンジニア',
            'work_hours' => '裁量労働制',
            'work_location' => '東京都新宿区',
            'first_assignment' => 'ソフトウェア開発',
            'status' => Status::InProgress,
        ]);

        Company::create([
            'user_id' => 1,
            'name' => 'デジタルコア株式会社',
            'url' => 'https://www.digitalcore.co.jp',
            'address' => '東京都中央区銀座4-4-4',
            'phone_number' => '03-4567-8901',
            'email' => 'recruit@digitalcore.co.jp',
            'corporate_philosophy' => 'デジタル化の推進',
            'ceo_message' => 'デジタルトランスフォーメーションを主導',
            'salary' => '年収350-600万円',
            'job_type' => 'ITコンサルタント',
            'work_hours' => '9:30-18:30',
            'work_location' => '東京都中央区',
            'first_assignment' => 'コンサルティング業務',
            'status' => Status::InProgress,
        ]);

        // 進行中の企業（面接ステップ）
        Company::create([
            'user_id' => 1,
            'name' => 'ネクストイノベーション株式会社',
            'url' => 'https://www.nextinnovation.co.jp',
            'address' => '東京都品川区大崎5-5-5',
            'phone_number' => '03-5678-9012',
            'email' => 'recruit@nextinnovation.co.jp',
            'corporate_philosophy' => '革新的なサービスの創造',
            'ceo_message' => '新しい価値の創造に挑戦',
            'salary' => '年収400-700万円',
            'job_type' => 'プロジェクトマネージャー',
            'work_hours' => 'フレックスタイム制',
            'work_location' => '東京都品川区',
            'first_assignment' => 'プロジェクト管理',
            'status' => Status::InProgress,
        ]);

        Company::create([
            'user_id' => 1,
            'name' => 'サイバーフロント株式会社',
            'url' => 'https://www.cyberfront.co.jp',
            'address' => '東京都千代田区丸の内6-6-6',
            'phone_number' => '03-6789-0123',
            'email' => 'recruit@cyberfront.co.jp',
            'corporate_philosophy' => 'サイバーセキュリティの追求',
            'ceo_message' => '安全なデジタル社会の実現',
            'salary' => '年収450-750万円',
            'job_type' => 'セキュリティエンジニア',
            'work_hours' => '9:00-18:00',
            'work_location' => '東京都千代田区',
            'first_assignment' => 'セキュリティシステムの構築',
            'status' => Status::InProgress,
        ]);

        // 不採用の企業
        Company::create([
            'user_id' => 1,
            'name' => 'クラウドテクノロジー株式会社',
            'url' => 'https://www.cloudtech.co.jp',
            'address' => '東京都台東区上野7-7-7',
            'phone_number' => '03-7890-1234',
            'email' => 'recruit@cloudtech.co.jp',
            'corporate_philosophy' => 'クラウドで業務改革',
            'ceo_message' => 'クラウドで企業を支援',
            'salary' => '年収400-650万円',
            'job_type' => 'クラウドエンジニア',
            'work_hours' => '9:00-18:00',
            'work_location' => '東京都台東区',
            'first_assignment' => 'クラウドシステムの構築',
            'status' => Status::Rejected,
        ]);

        // 内定の企業
        Company::create([
            'user_id' => 1,
            'name' => 'AIソリューション株式会社',
            'url' => 'https://www.aisolution.co.jp',
            'address' => '東京都文京区本郷8-8-8',
            'phone_number' => '03-8901-2345',
            'email' => 'recruit@aisolution.co.jp',
            'corporate_philosophy' => 'AIで未来を創造',
            'ceo_message' => 'AI技術で社会に貢献',
            'salary' => '年収500-800万円',
            'job_type' => 'AIエンジニア',
            'work_hours' => 'フレックスタイム制',
            'work_location' => '東京都文京区',
            'first_assignment' => 'AI開発プロジェクト',
            'status' => Status::UnofficialOffer,
        ]);
    }
}
