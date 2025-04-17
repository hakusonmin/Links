<script setup>
import ArticleForm from '@/mycomponents/components/Articles/ArticleForm.vue';
import BaseLayout from '@/mycomponents/layouts/BaseLayout.vue';
import { useForm } from '@inertiajs/vue3';

const props = defineProps({ article: Object });

const form = useForm({
  title: props.article.title,
  priority: props.article.priority,
  genres: [...props.article.genres.map(g => g.name)],
  links: [...props.article.links],
  content: props.article.content,
});

const submit = () => {
  form.put(route('articles.update', props.article.id));
};

</script>

<template>
  <BaseLayout>
    <div class="mx-auto my-[40px] max-w-[1400px]">
    <h1 class="text-xl font-bold my-6">記事の編集</h1>
    <ArticleForm :form="form" :onSubmit="submit" submitLabel="更新する" />
    </div>
  </BaseLayout>
</template>
