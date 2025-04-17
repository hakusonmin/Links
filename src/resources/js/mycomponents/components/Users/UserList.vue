<script setup>
import { Link } from '@inertiajs/vue3';

const props = defineProps({
  users: {
    type: Array,
    required: true,
  },
});
</script>

<template>
  <div class="mx-auto flex max-w-[960px] flex-col items-center">
    <div v-for="user in users" :key="user.id">
      <Link as="a" :href="route('users.articles.index', { user: user.id })" class="m-3 flex h-12 w-[380px] border-2 border-gray-400 bg-white">
        <img src="/images/Thumbnail.png" class="box-border w-20" />
        <div class="my-auto p-1">
          <div class="flex items-center justify-start text-center text-sm font-bold ml-2">
            <div class="mx-2 flex h-6 w-6 items-center justify-center rounded-md bg-black text-white">
              {{ user.name.charAt(0).toUpperCase() }}
            </div>
            <div class="mx-1">{{ user.name }}</div>
            <div class="mx-1">{{ user.followers_count }} Followers</div>
          </div>
        </div>
      </Link>
    </div>
  </div>
</template>

<style scoped></style>
