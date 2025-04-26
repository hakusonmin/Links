<script setup>
import Pagination from '@/mycomponents/components/Paginate/Pagination.vue';
import UserList from '@/mycomponents/components/Users/UserList.vue';
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
    <div class="mx-auto max-w-[960px]">
      <div class="mb-4 mt-8 text-xl font-bold">ユーザー検索</div>
      <input
        type="text"
        class="h-8 max-w-[350px] border-2 border-borderColor px-10 font-bold text-black sm:w-[450px]"
        v-model="form.query"
        placeholder="キーワードを入力してください"
        @keyup.enter="search"
      />
      <button @click="search"></button>

      <div class="mx-auto mb-1 mt-5 max-w-[390px] text-right">
        <label class="mx-1 font-semibold"> <input type="radio" value="latest" v-model="form.sort" @change="search" /> 最新順 </label>
        <label class="mx-1 font-semibold"> <input type="radio" value="followers" v-model="form.sort" @change="search" />フォロワー順 </label>
      </div>

      <UserList :users="users.data" />

      <Pagination :links="users.links" />
    </div>
  </ListLayout>
</template>

<style scoped></style>
