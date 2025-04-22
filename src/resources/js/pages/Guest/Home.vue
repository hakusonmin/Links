<template>
  <BaseLayout>
    <div class="mx-auto my-20 max-w-[960px] text-center">
      <div class="mx-auto font-bold text-3xl mb-6">Linksとは？</div>
      <div class="mt-4 font-bold text-[18px] mb-10 ">
        Linksは「おすすめの記事とそれに関する感想や考察」を<br />
        まとめて記事として投稿できるサービスです。<br />
        読んだ記事や本のリンクとともに感想や考察を記事として投稿してみましょう！
      </div>
      <div class="mt-4">
        <Link class="button" href="/articles/search" as="button">記事検索ページへ</Link>
        <Link class="button" href="/users/search" as="button">ユーザー検索ページへ</Link>
      </div>
    </div>
    <!-- ここページネーションを使わない場合は articles.data ではなく articlesで返す
    (これはjsonデータを見れば自明) -->
    <div class="mb-4 text-xl font-bold mx-auto text-center">月間記事ランキング</div>
    <ArticleList :articles="articles" />
  </BaseLayout>
</template>

<script setup>
import ArticleList from '@/mycomponents/components/Articles/ArticleList.vue';
import BaseLayout from '@/mycomponents/layouts/BaseLayout.vue';
import { Link } from '@inertiajs/vue3';

const props = defineProps({
  articles: Object,
});
</script>

<style scoped>
.button {
  background-color: var(--black);
  color: var(--white);
  margin: 0 20px;
  padding: 10px 20px;
  font-weight: bold;
}
</style>
