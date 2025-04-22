<script setup>
import ArticleList from '@/mycomponents/components/Articles/ArticleList.vue';
import Pagination from '@/mycomponents/components/Paginate/Pagination.vue';
import ListLayout from '@/mycomponents/layouts/ListLayout.vue';
import { useForm } from '@inertiajs/vue3';

const props = defineProps({
  articles: Object,
});

</script>

<template>
  <ListLayout>
    <div class="mx-auto max-w-[960px] mt-8">
      <div class="mb-4 text-xl font-bold">非公開中の記事一覧</div>

      <ArticleList :articles="articles.data" />

      <Pagination :links="articles.links" />
    </div>
  </ListLayout>
</template>

<style scoped>
.text-input {
  color: var(--black);
  font-weight: bold;
  padding: 0 10px;
  height: 30px;
  width: 450px;
  border: 2px solid var(--border-color);
}
</style>

