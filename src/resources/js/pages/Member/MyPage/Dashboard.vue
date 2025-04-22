<!-- resources/js/Pages/User/MyPage.vue -->
<template>
  <ListLayout>
    <div class="text-xl font-semibold mb-6 mt-8">ダッシュボード</div>
    <div class="flex flex-wrap max-w-[800px] mx-auto justify-center gap-2">
      <LinkButton :href="route('users.articles.index',{ user: user.id})" >自分のページ</LinkButton>
      <LinkButton href="/settings/profile" >アカウント管理</LinkButton>
      <LinkButton :href="route('articles.create')" >新規記事作成</LinkButton>
      <LinkButton :href="route('mypage.unpublished-articles')" >非公開記事一覧</LinkButton>
      <LinkButton :href="route('mypage.liked-articles')" >いいねした記事一覧</LinkButton>
      <LinkButton :href="route('mypage.followed-users')" >フォロー中のユーザー</LinkButton>
    </div>
  </ListLayout>
</template>

<script setup>
import LinkButton from '@/mycomponents/components/Buttons/LinkButton.vue';
import ListLayout from '@/mycomponents/layouts/ListLayout.vue';

const props = defineProps({
  user: Object,
});

</script>
