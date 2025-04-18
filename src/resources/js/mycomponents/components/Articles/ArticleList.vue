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
  <div class="wrapper">
    <div v-for="article in articles" :key="article.id">
      <Link as="a" :href="route('articles.show', { article: article.id })" class="article-card">
        <img src="/images/Thumbnail.png" />
        <div class="list-text">
          <div class="moe">{{ article.title }}</div>
          <div class="fuga">
            <div class="mx-2 flex h-5 w-5 items-center justify-center rounded-md bg-black text-xs text-white">
              {{ article.user.name.charAt(0).toUpperCase() }}
            </div>
            <div class="mx-1">{{ article.user.name }}</div>
            <div class="mx-1">{{ article.likes_count }} Likes</div>
          </div>
        </div>
      </Link>
    </div>
  </div>
</template>

<style scoped>
.wrapper {
  max-width: 960px;
  margin: 0 auto;
  display: flex;
  flex-direction: column;
  align-items: center;
}

.article-card {
  box-sizing: border-box;
  width: 485px;
  height: 80px;
  margin: 10px auto;
  border: 2px solid var(--border-color);
  display: flex;
  background-color: var(--white);
  overflow: hidden;
}

.article-card img {
  width: 120px;
  object-fit: cover;
}

.list-text {
  padding: 10px;
  display: flex;
  flex-direction: column;
  justify-content: space-between;
  flex: 1;
  word-break: break-word;
}

.moe {
  text-align: left;
  font-size: 14px;
  font-weight: bold;
}

.fuga {
  text-align: right;
  font-size: 14px;
  font-weight: bold;
  display: flex;
  justify-content: right;
}
</style>
