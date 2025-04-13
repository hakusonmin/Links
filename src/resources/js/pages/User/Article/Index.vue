<template>
    <ListLayout>
      <HeaderTitle title="話一覧" />
      <CardContainer>
        <Card v-for="article in articles" :key="article.id">
          <CardLink :href="route('user.articles.show', { chapter: article.chapter.id, article: article.id })" as="a">
            <CardImage src="/images/Thumbnail.png" />
            <CardTitle>{{ article.title }}</CardTitle>
          </CardLink>
          <MutateWrapper>
            <EditButton :href="route('user.articles.edit', { chapter: article.chapter.id, article: article.id })" as="button">編集</EditButton>
            <DeleteButton @click="handleDelete(article.id)">削除</DeleteButton>
          </MutateWrapper>
        </Card>
      </CardContainer>
      <LinkButton :href="route('user.articles.create', { chapter: articles[0].chapter.id })" as="button">新規章作成</LinkButton>
      <BackButton />
    </ListLayout>
  </template>

  <script setup>
  import BackButton from '@/mycomponents/components/Buttons/BackButton.vue';
  import CardLink from '@/mycomponents/components/Buttons/CardLink.vue';
  import DeleteButton from '@/mycomponents/components/Buttons/DeleteButton.vue';
  import EditButton from '@/mycomponents/components/Buttons/EditButton.vue';
  import LinkButton from '@/mycomponents/components/Buttons/LinkButton.vue';
  import Card from '@/mycomponents/components/Cards/Card.vue';
  import CardContainer from '@/mycomponents/components/Cards/CardContainer.vue';
  import CardImage from '@/mycomponents/components/Cards/CardImage.vue';
  import CardTitle from '@/mycomponents/components/Cards/CardTitle.vue';
  import MutateWrapper from '@/mycomponents/components/Cards/MutateWrapper.vue';
  import HeaderTitle from '@/mycomponents/components/Styles/HeaderTitle.vue';
  import ListLayout from '@/mycomponents/layouts/ListLayout.vue';
  import { router } from '@inertiajs/vue3';
  import { defineProps } from 'vue';

  const props = defineProps({
    articles: Array,
    chapter:Object,
  });

  const handleDelete = (id) => {
    router.delete(route('user.articles.destroy', { chapter: props.chapter.id, article: props.articles[0].id }), {
      onBefore: () => confirm('本当に削除しますか？'),
    });
  };
  </script>

  <style scoped></style>
