<script setup>
import ArticleForm from '@/mycomponents/components/Articles/ArticleForm.vue';
import BaseLayout from '@/mycomponents/layouts/BaseLayout.vue';
import { useForm } from '@inertiajs/vue3';

const form = useForm({
  title: '',
  priority: '',
  genres: [''],
  links: [{ title: '', url: '' }],
  content: '',
});

const submit = () => {
  form.post(route('articles.store'));
};

</script>

<template>
  <BaseLayout>
    <div class="mx-auto my-[40px] max-w-[1400px]">
    <h1 class="text-xl font-bold my-6">記事の新規作成</h1>
    <ArticleForm :form="form" :onSubmit="submit" submitLabel="投稿する" />
    </div>
  </BaseLayout>
</template>
