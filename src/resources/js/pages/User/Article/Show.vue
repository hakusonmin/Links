<template>
  <FormLayout>
    <HeaderTitle title="コンテンツ一覧" />
    <ShowInputField label="話名" v-model="article.title" />
    <ShowTextField label="話" v-model="article.content" />
    <LinkButton :href="route('user.articles.edit', { chapter: article.chapter.id, article: article.id })" as="button">編集</LinkButton>
    <ShowDeleteButton @click="handleDelete(article.id)">削除</ShowDeleteButton>
    <BackButton />
  </FormLayout>
</template>

<script setup>
import BackButton from '@/mycomponents/components/Buttons/BackButton.vue';
import LinkButton from '@/mycomponents/components/Buttons/LinkButton.vue';
import ShowDeleteButton from '@/mycomponents/components/Buttons/ShowDeleteButton.vue';
import ShowInputField from '@/mycomponents/components/Show/ShowInputField.vue';
import ShowTextField from '@/mycomponents/components/Show/ShowTextField.vue';
import HeaderTitle from '@/mycomponents/components/Styles/HeaderTitle.vue';
import FormLayout from '@/mycomponents/layouts/FormLayout.vue';
import { router } from '@inertiajs/vue3';
import { defineProps } from 'vue';

const props = defineProps({
    article: Object,
  });

  const handleDelete = (id) => {
    router.delete(route('user.articles.destroy', { chapter: props.article.chapter.id, article: props.article.id }), {
      onBefore: () => confirm('本当に削除しますか？'),
    });
  };
</script>
