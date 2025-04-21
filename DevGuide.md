### 開発環境の手順書です

# テストのシェルスクリプトに実行権限を付与
- chmod +x .vscode/run-laravel-test.sh

これにアクセスしてください
- http://localhost:8080/

dbeaverは 127.0.0.1:3307 でアクセス

testは専用のターミナルを開いた状態で Cute Artisan を起動する
↑(例えばnpm run devしているターミナルを開いている状態でCute Artisan実行すると npm run dev止まります)