<script setup>
import ArticleList from '@/mycomponents/components/Articles/ArticleList.vue';
import Pagination from '@/mycomponents/components/Paginate/Pagination.vue';
import ListLayout from '@/mycomponents/layouts/ListLayout.vue';
import { useForm } from '@inertiajs/vue3';

const props = defineProps({
  articles: Object,
  filters: Object,
});

const form = useForm({
  query: props.filters.query || '',
  sort: props.filters.sort || 'latest',
});

const search = () => {
  form.get(route('articles.search'), {
    preserveScroll: true,
    preserveState: true,
  });
};
</script>

<template>
  <ListLayout>
    <div class="mx-auto max-w-[960px]">
      <div class="mb-4 text-xl font-bold">記事検索</div>

      <input type="text" v-model="form.query" placeholder="キーワードを入力してください" @keyup.enter="search" class="text-input" />
      <button @click="search"></button>

      <div class="mx-auto mb-1 mt-10 w-[485px] text-right">
        <label class="mx-1 font-semibold"> <input type="radio" value="latest" v-model="form.sort" @change="search" /> 最新順 </label>
        <label class="mx-1 font-semibold"> <input type="radio" value="likes" v-model="form.sort" @change="search" /> いいね順 </label>
      </div>

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
