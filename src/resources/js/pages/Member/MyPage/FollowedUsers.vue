<script setup>
import Pagination from '@/mycomponents/components/Paginate/Pagination.vue';
import UserList from '@/mycomponents/components/Users/UserList.vue';
import ListLayout from '@/mycomponents/layouts/ListLayout.vue';

const props = defineProps({
  users: Object,
});
</script>

<template>
  <ListLayout>
    <div class="mx-auto mt-8 max-w-[960px]">
      <div class="mb-4 text-xl font-bold">フォローしたユーザー一覧</div>

      <UserList :users="users.data" />

      <Pagination :links="users.links" />

    </div>
  </ListLayout>
</template>
