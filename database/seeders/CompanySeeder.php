<?php

namespace Database\Seeders;

use App\Models\Company;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Company::create([
            'user_id' => 1,
            'name' => '株式会社ABC',
            'url' => 'https://www.abc.co.jp',
            'address' => '東京都渋谷区渋谷1-1-1',
            'phone_number' => '03-1234-5678',
            'email' => 'contact@abc.co.jp',
            'corporate_philosophy' => '人々の生活を豊かにする。',
            'ceo_message' => '私たちは常に挑戦し続けます。',
            'salary' => '年収500万円',
            'job_type' => 'ソフトウェアエンジニア',
            'work_hours' => '9:00 - 18:00',
            'work_location' => '東京都渋谷区',
            'first_assignment' => 'システム開発プロジェクトの担当',
            'status' => 0, // 進行中
        ]);

        Company::create([
            'user_id' => 1,
            'name' => '株式会社XYZ',
            'url' => 'https://www.xyz.co.jp',
            'address' => '大阪府大阪市北区梅田2-2-2',
            'phone_number' => '06-9876-5432',
            'email' => 'info@xyz.co.jp',
            'corporate_philosophy' => '革新を生み出す。',
            'ceo_message' => '新しい価値を創造し続けます。',
            'salary' => '年収400万円',
            'job_type' => '営業職',
            'work_hours' => '10:00 - 19:00',
            'work_location' => '大阪府大阪市',
            'first_assignment' => '営業戦略の立案',
            'status' => 1, // 不採用
        ]);

        Company::create([
            'user_id' => 1,
            'name' => '株式会社DEF',
            'url' => 'https://www.def.co.jp',
            'address' => '愛知県名古屋市中区栄3-3-3',
            'phone_number' => '052-1234-5678',
            'email' => 'contact@def.co.jp',
            'corporate_philosophy' => '社会貢献を最優先。',
            'ceo_message' => '未来をつくる企業であり続けます。',
            'salary' => '年収600万円',
            'job_type' => 'プロジェクトマネージャー',
            'work_hours' => '8:30 - 17:30',
            'work_location' => '愛知県名古屋市',
            'first_assignment' => 'プロジェクトの全体管理',
            'status' => 2, // 内定
        ]);

        Company::create([
            'user_id' => 1,
            'name' => '株式会社GHI',
            'url' => 'https://www.ghi.co.jp',
            'address' => '福岡県福岡市中央区天神4-4-4',
            'phone_number' => '092-555-1234',
            'email' => 'contact@ghi.co.jp',
            'corporate_philosophy' => '挑戦し続けることが私たちの強み。',
            'ceo_message' => 'お客様に寄り添ったサービスを提供します。',
            'salary' => '年収450万円',
            'job_type' => 'デザイナー',
            'work_hours' => '9:00 - 18:00',
            'work_location' => '福岡県福岡市',
            'first_assignment' => 'UI/UXデザインの担当',
            'status' => 0, // 進行中
        ]);

        Company::create([
            'user_id' => 1,
            'name' => '株式会社JKL',
            'url' => 'https://www.jkl.co.jp',
            'address' => '北海道札幌市中央区南1条西5丁目',
            'phone_number' => '011-1234-9876',
            'email' => 'info@jkl.co.jp',
            'corporate_philosophy' => 'お客様第一主義を徹底。',
            'ceo_message' => '地域に密着した事業運営をしています。',
            'salary' => '年収550万円',
            'job_type' => 'マーケティング職',
            'work_hours' => '9:00 - 18:00',
            'work_location' => '北海道札幌市',
            'first_assignment' => 'マーケティング戦略の立案',
            'status' => 1, // 不採用
        ]);

        Company::create([
            'user_id' => 1,
            'name' => '株式会社MNO',
            'url' => 'https://www.mno.co.jp',
            'address' => '東京都品川区大井町1-1-1',
            'phone_number' => '03-2345-6789',
            'email' => 'contact@mno.co.jp',
            'corporate_philosophy' => '技術革新と持続可能な社会を支える。',
            'ceo_message' => '常に進化を続ける企業です。',
            'salary' => '年収700万円',
            'job_type' => 'システムエンジニア',
            'work_hours' => '10:00 - 19:00',
            'work_location' => '東京都品川区',
            'first_assignment' => 'システムインフラの設計・運用',
            'status' => 2, // 内定
        ]);

        Company::create([
            'user_id' => 1,
            'name' => '株式会社PQR',
            'url' => 'https://www.pqr.co.jp',
            'address' => '京都府京都市下京区四条通',
            'phone_number' => '075-3456-7890',
            'email' => 'info@pqr.co.jp',
            'corporate_philosophy' => '環境に配慮した事業展開。',
            'ceo_message' => '社員一人一人の成長をサポートします。',
            'salary' => '年収500万円',
            'job_type' => 'カスタマーサポート',
            'work_hours' => '9:00 - 18:00',
            'work_location' => '京都府京都市',
            'first_assignment' => 'お客様対応の業務',
            'status' => 0, // 進行中
        ]);

        Company::create([
            'user_id' => 1,
            'name' => '株式会社STU',
            'url' => 'https://www.stu.co.jp',
            'address' => '兵庫県神戸市中央区三宮町1-1-1',
            'phone_number' => '078-1234-5678',
            'email' => 'contact@stu.co.jp',
            'corporate_philosophy' => '革新と誠実を追求。',
            'ceo_message' => '成長を支える環境があります。',
            'salary' => '年収650万円',
            'job_type' => '人事部門',
            'work_hours' => '9:00 - 18:00',
            'work_location' => '兵庫県神戸市',
            'first_assignment' => '採用活動の企画・運営',
            'status' => 1, // 不採用
        ]);

        Company::create([
            'user_id' => 1,
            'name' => '株式会社VWX',
            'url' => 'https://www.vwx.co.jp',
            'address' => '沖縄県那覇市牧志3-3-3',
            'phone_number' => '098-2345-6789',
            'email' => 'contact@vwx.co.jp',
            'corporate_philosophy' => '沖縄から世界へ。',
            'ceo_message' => '地域発展に貢献する企業です。',
            'salary' => '年収400万円',
            'job_type' => '販売職',
            'work_hours' => '9:00 - 18:00',
            'work_location' => '沖縄県那覇市',
            'first_assignment' => '店舗運営の担当',
            'status' => 0, // 進行中
        ]);
    }
}
