<!-- resources/js/Pages/Guest/Article/Show.vue -->
<script setup>
import BaseLayout from '@/mycomponents/layouts/BaseLayout.vue';
import { Link } from '@inertiajs/vue3';
import { computed } from 'vue';

const props = defineProps({
  article: Object,
  comments: Array,
  authUser: Object,
});

const isOwnArticle = computed(() => props.authUser?.id === props.article.user.id);
</script>

<template>
  <BaseLayout>
    <div class="mx-auto my-10 max-w-[960px] space-y-8">
      <div class="border border-gray-500 bg-gray-50 p-4">
        <h1 class="text-xl font-bold">{{ article.title }}</h1>
        <div class="my-2 flex flex-wrap gap-2">
          <span v-for="tag in article.tags" :key="tag" class="rounded bg-black px-2 py-1 text-sm text-white">{{ tag }}</span>
        </div>
        <div class="text-sm text-gray-700">優先度：{{ article.priority }} {{ article.likes }} likes 投稿日：{{ article.created_at }}</div>
      </div>

      <!-- リンク -->
      <div>
        <h2 class="font-bold">この記事のリンク一覧(読んでみよう!!)</h2>
        <div v-for="link in article.links" :key="link.id" class="my-2 flex items-center gap-2">
          <Link :href="link.link_url" class="flex w-full items-center gap-2 border border-gray-500 p-2">
            <span class="text-sm">🔗</span>
            <span>{{ link.title }}</span>
          </Link>
        </div>
      </div>

      <!-- 本文 -->
      <div>
        <h2 class="text-lg font-bold">本文</h2>
        <div class="">
          <div class="prose max-w-none">
            <div v-html="article.html_content"></div>
          </div>
        </div>
      </div>

      <!-- アクション -->
      <div class="flex gap-4">
        <button class="rounded bg-black px-4 py-2 font-bold text-white">いいねする</button>
        <button class="rounded bg-black px-4 py-2 font-bold text-white">コメントする</button>
      </div>

      <!-- コメント -->
      <div class="mt-8">
        <h2 class="mb-2 text-xl font-bold">コメント一覧</h2>
        <div v-for="comment in comments" :key="comment.id" class="mb-2 border border-gray-400 bg-white p-3">
          <div class="flex items-center gap-2 font-bold">
            <span class="flex h-5 w-5 items-center justify-center rounded-md bg-black text-xs text-white">
              {{ comment.user.name.charAt(0).toUpperCase() }}
            </span>
            <span>{{ comment.user.name }}</span>
            <button v-if="authUser?.id === comment.user.id" class="ml-auto text-sm text-blue-500">編集する</button>
          </div>
          <div class="mt-1 whitespace-pre-line text-sm">
            {{ comment.content }}
          </div>
        </div>
      </div>
    </div>
  </BaseLayout>
</template>
