<script setup>
import BaseLayout from '@/mycomponents/layouts/BaseLayout.vue';
import { useForm, router } from '@inertiajs/vue3';

const props = defineProps({
  article: Object,
  comment: Object,
});

const form = useForm({
  content: props.comment.content,
});

const submit = () => {
  form.put(route('comments.update', {
    article: props.article.id,
    comment: props.comment.id,
  }));
};

const destroy = () => {
  if (confirm('本当にこのコメントを削除しますか？')) {
    router.delete(route('comments.destroy', {
      article: props.article.id,
      comment: props.comment.id,
    }));
  }
};
</script>

<template>
  <BaseLayout>
    <div class="mx-auto my-10 max-w-[800px]">
      <div class="mb-4 font-bold">コメント編集</div>

      <textarea v-model="form.content" class="w-full border-2 border-borderColor p-2" rows="5"></textarea>

      <div class="mt-4 flex gap-4">
        <button @click="submit" class="bg-black px-4 py-1.5 text-white font-bold">更新</button>
        <button @click="destroy" class="bg-black px-4 py-1.5 text-white font-bold">削除</button>
      </div>
    </div>
  </BaseLayout>
</template>
