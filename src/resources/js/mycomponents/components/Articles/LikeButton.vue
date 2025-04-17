<script setup>
import { router } from '@inertiajs/vue3';

const props = defineProps({
  articleId: Number,
  isLiked: Boolean,
});

const toggleLike = () => {
  if (props.isLiked) {
    router.delete(route('articles.unlike', { article: props.articleId }));
  } else {
    router.post(route('articles.like', { article: props.articleId }));
  }
};
</script>

<template>
  <button
    @click="toggleLike"
    class="bg-black px-4 py-2 text-white font-bold"
  >
    {{ isLiked ? 'いいね中' : 'いいね' }}
  </button>
</template>
