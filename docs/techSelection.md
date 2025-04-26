### 技術選定書(TechSelection)
***

- フロントエンド
  - Vue.js：Laravelと一緒に使われる場合が多く、Laravel+Vue.jsの資料が豊富にあるため
  - TailwindCSS:laravel12のStarter-kitに標準搭載されているから
  - Tailwind Variants
  - ESlint：laravel12のStarter-kitに標準搭載されているから
  - Prettier:laravel12のStarter-kitに標準搭載されているから

- バックエンド
  - PHP
  - Laravel：バックエンドフレームワークの中では一番メジャー(Pestを導入するため11系に下げた)
  - Inertia.js：Laravelの資産を利用するため。また、Laravel12系からは公式認定のデファクトスタンダードとなっており、認証系もInertia.js前提で組み込まれている
    [仕組みのリンク](https://inertiajs.com/how-it-works)
  - [Pest](https://pestphp.com/): PHPUnitラッバー JestのようなBDDを意識した仕様

- インフラ
  - Docker：composeで管理 (Nginx+PHP+MySQL)
  - AWS Lightsail：Dockerを利用するためFargateかLightsailのどちらかでしたが、開発の規模等を考慮し、LightSailを採用した。
  またLightsailはコンテナデプロイではなくインスタンスによる手動でのDocker起動を採用している。理由としては今回の構成ではCompose内にMySQLも組み込んだため
  コンテナデプロイを使うと外部DBを利用する必要があり相性が良くないと判断したからだ。
  - Route53：ドメインの取得に使用
  - CertBot：SSLのため使用 
---
### アーキテクチャ選定
- フロントエンド(Vue.js)
  - なるべくコンポーネントに分けて、`Page` ディレクトリの配下で `style`を大量に当てることがない状態を目指す。
- バックエンド
  - Laravelはなるべくフレームワークの思想(`make:model -a`したときのディレクトリ構成)に則り開発する。exバリデーションはフォームバリデーションに分離する.認証はミドルウェアとポリシーで行いControllerには書かない.
- インフラ
  - dockerを使うことでサーバー間の接続エラーを減らし、インフラ自体の安定性も高くなる
---
