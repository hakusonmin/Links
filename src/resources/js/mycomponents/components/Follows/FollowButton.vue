<script setup>
import { router } from '@inertiajs/vue3';

const props = defineProps({
  user: Object,
});

const toggleFollow = () => {
  router.post(`/users/${props.user.id}/follow`, {}, {
    preserveScroll: true,
  });
};
</script>

<template>
  <button
    @click="toggleFollow"
    class="bg-black text-white px-4 py-1.5 font-bold text-[14px]"
  >
    フォローする
  </button>
</template>
