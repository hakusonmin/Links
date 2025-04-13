<template>
  <FormLayout>
    <HeaderTitle title="コンテンツ一覧" />
    <ShowInputField label="話名" v-model="article.title" />
    <ShowTextField label="話" v-model="article.content" />
    <BackButton />
  </FormLayout>
</template>

<script setup>
import BackButton from '@/mycomponents/components/Buttons/BackButton.vue';
import ShowInputField from '@/mycomponents/components/Show/ShowInputField.vue';
import ShowTextField from '@/mycomponents/components/Show/ShowTextField.vue';
import HeaderTitle from '@/mycomponents/components/Styles/HeaderTitle.vue';
import FormLayout from '@/mycomponents/layouts/FormLayout.vue';
import { defineProps } from 'vue';

const props = defineProps({
  article: Object,
});

</script>
