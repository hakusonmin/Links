<!-- components/BackButton.vue -->
<template>
  <button class="submit-button" type="submit">
    <slot />
  </button>
</template>

<script setup></script>

<style scoped>
.submit-button {
  appearance: none;
  margin: 10px;
  padding: 8px 16px;
  color: var(--white);
  background-color: var(--black);
}
</style>

<script setup>
import BackButton from '@/mycomponents/components/Buttons/BackButton.vue';
import CardContainer from '@/mycomponents/components/Cards/CardContainer.vue';
import HeaderTitle from '@/mycomponents/components/Styles/HeaderTitle.vue';
import ListLayout from '@/mycomponents/layouts/ListLayout.vue';
import { Link, router } from '@inertiajs/vue3';
import { defineProps, onMounted } from 'vue';

const props = defineProps({
  chapters: Array,
});

onMounted(() => {
  //JSON.stringifyを使うと展開出来て便利
  console.log(JSON.stringify(props.chapters));
});

const handleDelete = (id) => {
  router.delete(route('user.chapters.destroy', { chapter: id }), {
    onBefore: () => confirm('本当に削除しますか？'),
  });
};
</script>


