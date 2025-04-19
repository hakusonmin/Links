<script setup>
import BaseLayout from '@/mycomponents/layouts/BaseLayout.vue';
import { useForm } from '@inertiajs/vue3';

const props = defineProps({ article: Object });

const form = useForm({ content: '' });

const submit = () => {
  form.post(route('comments.store', { article: props.article.id }));
};
</script>

<template>
  <BaseLayout>
    <div class="mx-auto my-10 max-w-[800px]">
      <div class="font-bold mb-4">コメント投稿 (500字以内)</div>
      <textarea v-model="form.content" class="w-full border-2 border-borderColor p-2" rows="5" maxlength="500"></textarea>
      <button @click="submit" class="mt-2 bg-black px-4 py-1.5 text-white">投稿</button>
    </div>
  </BaseLayout>
</template>
