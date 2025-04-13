<script setup>
import BackButton from '@/mycomponents/components/Buttons/BackButton.vue';
import SubmitButton from '@/mycomponents/components/Buttons/SubmitButton.vue';
import InputField from '@/mycomponents/components/Forms/InputField.vue';
import TextField from '@/mycomponents/components/Forms/TextField.vue';
import HeaderTitle from '@/mycomponents/components/Styles/HeaderTitle.vue';
import FormLayout from '@/mycomponents/layouts/FormLayout.vue';
import { useForm } from '@inertiajs/vue3';

// useForm でフォームデータを管理する
const form = useForm({
  title: '',
  content: '',
});

const props = defineProps({
  chapter: Object,
});

// 送信処理
const submit = () => {
  form.post(route('user.articles.store', { chapter: props.chapter.id }));
};
</script>

<template>
  <FormLayout>
    <HeaderTitle title="話" />
    <form @submit.prevent="submit">
      <InputField label="話名" v-model="form.title" />
      <TextField label="内容" v-model="form.content" />
      <SubmitButton>作成</SubmitButton>
      <BackButton />
    </form>
  </FormLayout>
</template>

<style scoped></style>


