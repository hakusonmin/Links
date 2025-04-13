<template>
  <ListLayout>
    <HeaderTitle title="章一覧" />
    <CardContainer>
      <Card v-for="chapter in chapters" :key="chapter.id">
        <CardLink :href="route('guest.articles.index', { chapter: chapter.id })" as="a">
          <CardImage src="/images/Thumbnail.png" />
          <CardTitle>{{ chapter.title }}</CardTitle>
        </CardLink>
      </Card>
    </CardContainer>
    <BackButton />
  </ListLayout>
</template>

<script setup>
import BackButton from '@/mycomponents/components/Buttons/BackButton.vue';
import CardLink from '@/mycomponents/components/Buttons/CardLink.vue';
import Card from '@/mycomponents/components/Cards/Card.vue';
import CardContainer from '@/mycomponents/components/Cards/CardContainer.vue';
import CardImage from '@/mycomponents/components/Cards/CardImage.vue';
import CardTitle from '@/mycomponents/components/Cards/CardTitle.vue';
import HeaderTitle from '@/mycomponents/components/Styles/HeaderTitle.vue';
import ListLayout from '@/mycomponents/layouts/ListLayout.vue';
import { defineProps } from 'vue';

const props = defineProps({
  chapters: Array,
  novel: Object,
});
</script>

<style scoped></style>
