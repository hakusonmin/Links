<!-- resources/js/mycomponents/articles/TogglePublishButton.vue -->
<script setup>
import { router } from '@inertiajs/vue3';
import { computed } from 'vue';

const props = defineProps({
  article: Object,
});

const isPublished = computed(() => props.article.is_published);

const toggle = () => {
  router.put(route('articles.togglePublish', { article: props.article.id }));
};
</script>

<template>
  <button @click="toggle" class="bg-black px-4 py-2 font-bold text-white">
    {{ isPublished ? '非公開にする' : '公開する' }}
  </button>
</template>
