# 転職マネージャー

## 概要
転職活動の進捗状況を一元管理するためのWebアプリケーションです。複数の企業の応募状況や面接の進捗状況を効率的に管理できます。

## 機能一覧
- 企業情報の登録・管理
- 応募状況の進捗管理（履歴書、職務経歴書、エントリーフォームなど）
- 進捗状況が進んでいる企業ほど上位に表示
- 面接スケジュールの管理
- ステータスに基づいた企業の絞り込み表示
- Googleアカウントでのログイン対応
  
## 実装予定機能
- GoogleカレンダーとのAPI連携
- AI面接対策
  
## 技術スタック
- フレームワーク：Laravel
- 開発環境:Docker(Laravel Sail)
- データベース:MySQL
- 認証:Laravel Breeze, GoogleOAuth
- フロントエンド:Tailwind CSS
  
## 環境構築

### 必要要件
- Docker Desktop
- PHP8.2以上
- Composer
- Node.js と npm
  
## インストール手順
### 1. リポジトリのクローン
```bash
git clone https://github.com/masa7134/job-change-manager.git
```

```bash
cd job-change-manager
```

### 2. 環境変数ファイルの作成
```bash
cp .env.example .env
```

### 3. 依存パッケージのインストール
```bash
composer install
```

※　上記コマンドでエラーが発生する場合は、以下のコマンドを使用してください。
```bash
docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v "$(pwd):/var/www/html" \
    -w /var/www/html \
    laravelsail/php84-composer:latest \
    composer install --ignore-platform-reqs
```

### 4. Laravel Sailのインストール
```bash
php artisan sail:install
```

### 5. Sailエイリアスの設定（オプション）
```bash
alias sail='[ -f sail ] && sh sail || sh vendor/bin/sail'
```

### 6. Sailの起動
```bash
./vendor/bin/sail up -d
```

### 7. NPMパッケージのインストールとビルド
```bash
sail npm install
```

```bash
sail npm run build
```

### 8. アプリケーションキーの生成
```bash
sail artisan key:generate
```

### 9. マイグレーションとシーディングの実行
```bash
sail artisan migrate --seed
```

### インストール完了後、ブラウザで以下のURLにアクセスしてください。
http://localhost

### デプロイ済みアプリケーション
https://job-change-manager.com/

### テストアカウントとパスワード
以下のテストアカウントを利用して、アプリケーションの機能を確認できます。
- メールアドレス:test@example.com
- パスワード:password

## 参考画像
<img width="1290" alt="スクリーンショット 2024-12-18 10 05 52" src="https://github.com/user-attachments/assets/01908142-f68a-4d5a-a2a9-050f5bd93be0" />
<img width="1237" alt="スクリーンショット 2024-12-18 10 06 48" src="https://github.com/user-attachments/assets/b45a2a75-40dd-485a-8dc1-c1bd7165ac81" />
<img width="1260" alt="スクリーンショット 2024-12-18 10 07 48" src="https://github.com/user-attachments/assets/3bbdef8a-f9a8-4e01-a4ef-1f5be5b05502" />

 
