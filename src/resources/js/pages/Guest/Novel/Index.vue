<template>
    <ListLayout>
      <HeaderTitle title="小説一覧" />
      <CardContainer>
        <Card v-for="novel in novels" :key="novel.id">
          <CardLink :href="route('guest.chapters.index', { novel: novel.id })" as="a">
            <CardImage src="/images/Thumbnail.png"/>
            <CardTitle >{{ novel.title }}</CardTitle>
          </CardLink>
        </Card>
      </CardContainer>
      <BackButton />
    </ListLayout>
  </template>

  <script setup>
  import { router } from '@inertiajs/vue3';
  import { defineProps } from 'vue';
  import ListLayout from '@/mycomponents/layouts/ListLayout.vue';
  import BackButton from '@/mycomponents/components/Buttons/BackButton.vue';
  import CardLink from '@/mycomponents/components/Buttons/CardLink.vue';
  import CardContainer from '@/mycomponents/components/Cards/CardContainer.vue';
  import CardImage from '@/mycomponents/components/Cards/CardImage.vue';
  import CardTitle from '@/mycomponents/components/Cards/CardTitle.vue';
  import Card from '@/mycomponents/components/Cards/Card.vue';
  import HeaderTitle from '@/mycomponents/components/Styles/HeaderTitle.vue';

  const props = defineProps({
    novels: Array,
  });

  const handleDelete = (id) => {
    router.delete(route('guest.novels.destroy', { novel: id }), {
      onBefore: () => confirm('本当に削除しますか？'),
    });
  };
  </script>

  <style scoped>
  </style>
