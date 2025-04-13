<template>
  <ListLayout>
    <HeaderTitle title="章一覧" />
    <CardContainer>
      <Card v-for="chapter in chapters" :key="chapter.id">
        <CardLink :href="route('user.articles.index', { chapter: chapter.id })" as="a">
          <CardImage src="/images/Thumbnail.png" />
          <CardTitle>{{ chapter.title }}</CardTitle>
        </CardLink>
        <MutateWrapper>
          <EditButton :href="route('user.chapters.edit', { novel: chapter.novel.id, chapter: chapter.id })" as="button">編集</EditButton>
          <DeleteButton @click="handleDelete(chapter.id)">削除</DeleteButton>
        </MutateWrapper>
      </Card>
    </CardContainer>
    <LinkButton :href="route('user.chapters.create', { novel: chapters[0].novel.id })" as="button">新規章作成</LinkButton>
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
  chapters: Array,
  novel:Object,
});

const handleDelete = (id) => {
  router.delete(route('user.chapters.destroy', { novel: props.novel.id, chapter: props.chapters[0].id }), {
    onBefore: () => confirm('本当に削除しますか？'),
  });
};
</script>

<style scoped></style>
