<template>
  <BaseLayout>
    <div class="mx-auto my-20 max-w-[960px] text-center">
      <div class="mx-auto font-bold text-3xl mb-6">Linksとは？</div>
      <div class="mt-4 max-w-[450px] m-auto font-bold text-[18px] mb-10 ">
        Linksは「おすすめの記事とそれに関する感想や考察」をまとめて記事として投稿できるサービスです。<br />
        読んだ記事や本のリンクとともに感想や考察を記事として投稿してみましょう！
      </div>
      <div class="mt-4">
        <Link :class="button()" href="/articles/search" as="button">記事検索ページへ</Link>
        <Link :class="button()" href="/users/search" as="button">ユーザー検索ページへ</Link>
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
import { tv } from 'tailwind-variants';

const props = defineProps({
  articles: Object,
});

const button = tv({
  base: 'bg-black text-white m-[5px_20px] px-5 py-2.5 font-bold',
})
</script>

<style scoped></style>
