<script setup>
import ArticleCard from '@/mycomponents/components/Articles/ArticleCard.vue';
import Pagination from '@/mycomponents/components/Paginate/Pagination.vue';
import UserProfileCard from '@/mycomponents/components/Users/UserProfileCard.vue';
import ListLayout from '@/mycomponents/layouts/ListLayout.vue';
import { router } from '@inertiajs/vue3';
import { ref, watchEffect } from 'vue';

const props = defineProps({
  user: Object,
  articles: Object,
  filters: Object,
});

const sort = ref(props.filters.sort || 'priority');

const changeSort = () => {
  router.get(
    route('users.articles.index', { user: props.user.id}),
    { sort: sort.value },
    {
      preserveScroll: true,
      preserveState: true,
    },
  );
};
</script>

<template>
  <ListLayout>
    <UserProfileCard :user="user" />

    <div class="my-8 text-center text-xl font-bold">記事一覧</div>

    <div class="my-4 text-right text-sm font-bold">
      <label class="mx-2">
        <input type="radio" value="priority" v-model="sort" @change="changeSort" />
        優先度順
      </label>
      <label class="mx-2">
        <input type="radio" value="latest" v-model="sort" @change="changeSort" />
        最新順
      </label>
      <label class="mx-2">
        <input type="radio" value="likes" v-model="sort" @change="changeSort" />
        いいね順
      </label>
    </div>
    <ArticleCard :articles="articles.data" />

    <Pagination :links="articles.links" />
  </ListLayout>
</template>
