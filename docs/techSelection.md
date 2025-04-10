### 技術選定(TechSelection)
***

- フロントエンド
  - Vue.js：Laravelと一緒に使われる場合が多く、Laravel+Vue.jsの資料が沢山あることから
  - TailwindCSS:laravel12のStarter-kitに標準搭載されているから
  - ESlint：laravel12のStarter-kitに標準搭載されているから
  - Prettier:laravel12のStarter-kitに標準搭載されているから

- バックエンド
  - PHP
  - Laravel：バックエンドフレームワークの中では一番メジャー
  - Inertia.js：LaravelのRouteModelBindingやAccessorなどの資産を使うために採用
  - MySQL

- インフラ
  - Docker：composeで管理する
  - AWS LightSail：AWSでコンテナをデプロイしたい場合にFargateやEC2などのいろんな選択肢がある。Fargateは私が開発するサービスに対して大げさで、EC2はRDSやVPCなどの料金もかかる。よって LightSailを利用することにする。
    - アクセス方法は `Cloud Shell` を利用する(アクセスキーの発行を阻止するため)
---
### アーキテクチャ選定
- フロントエンド(Vue.js)
  - なるべくコンポーネントに分けて、`Page` ディレクトリの配下で `style`を大量に当てることがない状態を目指す。
- バックエンド
  - Laravelはなるべくフレームワークの思想(`make:model -a`したときのディレクトリ構成)に則り開発する。exバリデーションはフォームバリデーションに分離する.認証はミドルウェアとポリシーで行いControllerには書かない.
- インフラ
  - dockerを使うことでサーバー間の接続エラーを減らし、インフラ自体の安定性も高くなる
---
