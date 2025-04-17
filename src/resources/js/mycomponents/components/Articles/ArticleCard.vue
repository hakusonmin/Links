<script setup>
import { Link } from '@inertiajs/vue3';

const props = defineProps({
  articles: Array,
});
</script>

<template>
  <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 md:grid-cols-3">
    <div v-for="article in articles" :key="article.id" class="m-3 border-2 border-gray-400 bg-white">
      <Link as="a" :href="route('articles.show', { article: article.id  })">
        <img src="/images/Thumbnail.png" class="box-border max-h-[100px] w-[250px]" />
        <div class="p-2">
          <div class="line-clamp-2 text-left text-sm font-bold">
            {{ article.title }}
          </div>
          <div class="flex justify-end text-sm font-bold">
            <div class="mx-1">優先度 {{ article.priority }}</div>
            <div class="mx-1">{{ article.likes }} Likes</div>
          </div>
        </div>
      </Link>
    </div>
  </div>
</template>
