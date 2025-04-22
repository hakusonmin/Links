<!-- resources/js/Pages/Guest/Article/Show.vue -->
<script setup>
import LikeButton from '@/mycomponents/components/Articles/LikeButton.vue';
import TogglePublishButton from '@/mycomponents/components/Articles/TogglePublishButton.vue';
import BaseLayout from '@/mycomponents/layouts/BaseLayout.vue';
import { Link } from '@inertiajs/vue3';
import { Link as LinkIcon } from 'lucide-vue-next';
import { computed, ref } from 'vue';

const props = defineProps({
  article: Object,
  comments: Array,
  authUser: Object,
});

const isOwnArticle = computed(() => props.authUser?.id === props.article.user.id);

const onDelete = (event) => {
  if (window.confirm('本当にこの記事を削除しますか？')) {
    event.target.submit();
  }
};

// 各リンクの表示状態を保持（IDごとにtrue/false）
const showComments = ref({});

const toggleComment = (id) => {
  showComments.value[id] = !showComments.value[id];
};
</script>

<template>
  <BaseLayout>
    <div class="mx-auto my-10 max-w-[960px] space-y-8">
      <div class="border-2 border-gray-500 bg-gray-50 p-4">
        <!-- ユーザー情報 -->
        <Link as="a" :href="route('users.articles.index', { user: article.user.id })">
          <div class="mb-3 flex justify-start text-center">
            <div class="flex h-6 w-6 items-center justify-center rounded-md bg-black font-bold text-white">
              {{ article.user.name.charAt(0).toUpperCase() }}
            </div>
            <div class="flex text-center font-bold">
              <div class="mx-2 my-auto text-center">{{ article.user.name }}</div>
            </div>
          </div>
        </Link>
        <!-- 記事タイトル -->
        <h1 class="text-xl font-bold">{{ article.title }}</h1>

        <!-- ジャンル -->
        <div class="my-2 flex flex-wrap justify-end gap-4">
          <span v-for="genre in article.genres" :key="genre" class="bg-black px-4 py-1 text-sm font-bold text-white">
            <Link as="a" :href="route('articles.genre', { genre: genre.id })">
              {{ genre.name }}
            </Link>
          </span>
        </div>
        <!-- 記事情報 -->
        <div class="flex justify-end gap-4 font-bold text-black text-gray-700">
          <div>優先度：{{ article.priority }}</div>
          <div>{{ article.likes_count }} likes</div>
          <div>投稿日：{{ article.formatted_created_at }}</div>
          <div>更新日：{{ article.formatted_updated_at }}</div>
        </div>
      </div>

      <!-- リンク -->
      <div>
        <h2 class="font-bold">この記事のリンク一覧とコメント(読んでみよう!!)</h2>
        <div v-for="link in article.links" :key="link.id" class="my-2 flex items-center gap-2 font-bold">
          <div class="flex w-full gap-1 items-start">
            <button class="p-2 py-auto" type="button" @click.prevent="toggleComment(link.id)">
              {{ showComments[link.id] ? '▼' : '▶' }}
            </button>
            <div class="w-full border-2 border-gray-500 bg-white ">
              <div class="p-1">
                <a :href="link.link_url" target="_blank" rel="noopener noreferrer" class="flex items-center gap-2">
                  <LinkIcon class="h-5 w-5" />
                  <span>{{ link.title }}</span>
                </a>
              </div>
              <div v-if="showComments[link.id]" class="py-1 px-4 border-t-2 border-gray-500 min-h-[7rem] whitespace-pre-line">
                <div class="font-normal">{{ link.comment }}</div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- 本文 -->
      <div>
        <h2 class="text-lg font-bold">解説</h2>
        <div class="border-2 border-gray-500 bg-white px-6">
          <div class="prose max-w-none text-black">
            <div v-html="article.html_content"></div>
          </div>
        </div>
      </div>

      <!-- ボタン -->
      <div class="flex justify-center gap-4">
        <template v-if="isOwnArticle">
          <!-- ログイン中のユーザーが投稿者の場合 -->
          <Link :href="route('articles.edit', { article: article.id })" class="bg-black px-4 py-2 font-bold text-white"> 編集する </Link>
          <form :action="route('articles.destroy', { article: article.id })" method="post" @submit.prevent="onDelete">
            <input type="hidden" name="_method" value="delete" />
            <button type="submit" class="bg-black px-4 py-2 font-bold text-white">削除する</button>
          </form>
          <TogglePublishButton :article="article" />
        </template>

        <template v-else>
          <!-- 他ユーザーの場合 -->
          <LikeButton :article-id="article.id" :is-liked="article.isLiked" />
          <Link as="button" :href="route('comments.create', { article: article.id })" class="bg-black px-4 py-2 font-bold text-white"
            >コメントする</Link
          >
        </template>
      </div>

      <!-- コメント -->
      <div class="mt-8">
        <h2 class="mb-2 text-xl font-bold">コメント一覧</h2>
        <div v-for="comment in comments" :key="comment.id" class="mb-2 border-2 border-gray-500 bg-white p-3">
          <Link as="a" :href="route('users.articles.index', { user: article.user.id })">
            <div class="flex items-center gap-2 font-bold">
              <span class="flex h-5 w-5 items-center justify-center rounded-md bg-black text-xs text-white">
                {{ comment.user.name.charAt(0).toUpperCase() }}
              </span>
              <span>{{ comment.user.name }}</span>
              <Link
                v-if="authUser?.id === comment.user.id"
                as="button"
                :href="route('comments.edit', { article: article.id, comment: comment.id })"
                class="ml-auto mr-1 bg-black px-4 py-1 text-right text-[14px] text-white"
              >
                編集する
              </Link>
            </div>
          </Link>
          <div class="mt-2 whitespace-pre-line text-sm">
            {{ comment.content }}
          </div>
        </div>
      </div>
    </div>
  </BaseLayout>
</template>
