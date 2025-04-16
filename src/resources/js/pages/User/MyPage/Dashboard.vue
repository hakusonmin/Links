<!-- resources/js/Pages/User/MyPage.vue -->
<template>
  <ListLayout>
    <div class="text-xl font-semibold mb-14">ダッシュボード</div>
    <div class="flex flex-wrap max-w-[500px] mx-auto justify-center gap-4">
      <LinkButton :href="route('users.articles.index', { user: user.id })" >マイページ</LinkButton>
      <LinkButton href="/my-articles" >新規記事作成</LinkButton>
      <LinkButton href="/settings/profile" >アカウント管理</LinkButton>
      <LinkButton href="/my-articles" >フォローしているユーザー一覧</LinkButton>
      <LinkButton href="/my-articles" >いいねした記事一覧</LinkButton>
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
