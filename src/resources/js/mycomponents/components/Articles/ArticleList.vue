<script setup>
import { Link } from '@inertiajs/vue3';

const props = defineProps({
  articles: {
    type: Array,
    required: true,
  },
});
</script>

<template>
  <div class="flex w-full justify-center">
    <div class="mx-auto flex max-w-[960px] flex-col items-center">
    <!-- ↓ここの w-full と imgの下のdivの flex-1 がセットで動きます -->
      <div v-for="article in articles" :key="article.id" class="w-full">
        <Link
          as="a"
          :href="route('articles.show', { article: article.id })"
          class="my-2 flex h-20 w-full max-w-[485px] border-2 border-gray-400 bg-white"
        >
          <img src="/images/Thumbnail.png" class="w-[125px] object-cover" />
          <div class="flex flex-1 flex-col justify-between p-2.5">
            <div class="min-h-[2.5rem] break-words text-left text-sm font-bold">{{ article.title }}</div>
            <div class="items-right flex justify-end text-sm font-bold">
              <div class="mx-2 flex h-5 w-5 items-center justify-center rounded-md bg-black text-xs text-white">
                {{ article.user.name.charAt(0).toUpperCase() }}
              </div>
              <div class="mx-1 w-[100px] text-center">{{ article.user.name }}</div>
              <div class="w-[80px] text-left">{{ article.likes_count }} Likes</div>
            </div>
          </div>
        </Link>
      </div>
    </div>
  </div>
</template>

<style scoped></style>
