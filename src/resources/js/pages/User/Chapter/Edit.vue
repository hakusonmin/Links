<template>
  <FormLayout>
    <HeaderTitle title="小説編集" />
    <form @submit.prevent="submit">
      <InputField label="小説名" v-model="form.title" />
      <SubmitButton>更新</SubmitButton>
      <BackButton />
    </form>
  </FormLayout>
</template>

<script setup>
import BackButton from '@/mycomponents/components/Buttons/BackButton.vue';
import SubmitButton from '@/mycomponents/components/Buttons/SubmitButton.vue';
import InputField from '@/mycomponents/components/Forms/InputField.vue';
import HeaderTitle from '@/mycomponents/components/Styles/HeaderTitle.vue';
import FormLayout from '@/mycomponents/layouts/FormLayout.vue';
import { useForm, usePage } from '@inertiajs/vue3';

// フォームデータの取得（既存のデータを編集する）
const { props } = usePage();

// 既存データをセット
const form = useForm({
  title: props.chapter.title ?? '',
});

const submit = () => {
  form.put(route('user.chapters.update', { novel: props.chapter.novel.id, chapter: props.chapter.id }));
};
</script>

<style scoped></style>
