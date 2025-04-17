<!-- resources/js/Pages/User/MyPage.vue -->
<template>
  <ListLayout>
    <div class="text-xl font-semibold mb-6 mt-8">ダッシュボード</div>
    <div class="flex flex-wrap max-w-[500px] mx-auto justify-center gap-4">
      <LinkButton :href="route('users.articles.index',{ user: user.id})" >マイページ</LinkButton>
      <LinkButton :href="route('articles.create')" >新規記事作成</LinkButton>
      <LinkButton href="/settings/profile" >アカウント管理</LinkButton>
      <LinkButton :href="route('mypage.liked-articles')" >いいねした記事一覧</LinkButton>
      <LinkButton :href="route('mypage.followed-users')" >フォローしているユーザー一覧</LinkButton>
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
