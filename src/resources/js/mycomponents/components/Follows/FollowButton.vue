<script setup>
import { router } from '@inertiajs/vue3';
import { computed } from 'vue';
import { usePage } from '@inertiajs/vue3';

const props = defineProps({ user: Object });
const page = usePage();
const authUser = page.props.auth?.user;

// ArticleController::indexedDB()で突っ込んだ値を確認
const isFollowing = computed(() => props.user.isFollowed);
const toggleFollow = () => {
  if (isFollowing.value) {
    router.delete(route('unfollow', { user: props.user.id }), { preserveScroll: true });
  } else {
    router.post(route('follow', { user: props.user.id }), { preserveScroll: true });
  }
};
</script>

<template>
  <button @click="toggleFollow" class="bg-black  text-sm px-4 py-1.5 text-white font-bold">
    {{ isFollowing ? 'フォロー中' : 'フォロー' }}
  </button>
</template>
