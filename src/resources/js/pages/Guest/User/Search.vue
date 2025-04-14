<script setup>
import UserList from '@/mycomponents/components/Users/UserList.vue';
import Pagination from '@/mycomponents/components/Paginate/Pagination.vue';
import ListLayout from '@/mycomponents/layouts/ListLayout.vue';
import { useForm } from '@inertiajs/vue3';

const props = defineProps({
  users: Object,
  filters: Object,
});

const form = useForm({
  query: props.filters.query || '',
  sort: props.filters.sort || 'latest',
});

const search = () => {
  form.get(route('users.search'), {
    preserveScroll: true,
    preserveState: true,
  });
};
</script>

<template>
  <ListLayout>
    <div class="super-wrapper">
      <div class="mb-4 text-xl font-bold">記事検索</div>

      <input type="text" v-model="form.query" placeholder="キーワードで検索" @keyup.enter="search" class="text-input" />
      <button @click="search"></button>

      <div class="mx-auto mb-1 mt-10 w-[485px] text-right">
        <label class="mx-1 font-semibold"> <input type="radio" value="latest" v-model="form.sort" @change="search" /> 最新順 </label>
        <label class="mx-1 font-semibold"> <input type="radio" value="followers" v-model="form.sort" @change="search" />フォロワー順 </label>
      </div>

      <UserList :users="users.data" />

      <Pagination :links="users.links" />
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

.super-wrapper {
  max-width: 960px;
  margin: 0 auto;
}

</style>
