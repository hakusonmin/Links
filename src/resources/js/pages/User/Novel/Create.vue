<script setup>
import BackButton from '@/mycomponents/components/Buttons/BackButton.vue';
import SubmitButton from '@/mycomponents/components/Buttons/SubmitButton.vue';
import InputField from '@/mycomponents/components/Forms/InputField.vue';
import HeaderTitle from '@/mycomponents/components/Styles/HeaderTitle.vue';
import FormLayout from '@/mycomponents/layouts/FormLayout.vue';
import { useForm } from '@inertiajs/vue3';

// useForm でフォームデータを管理する
const form = useForm({
  title: '',
});

// 送信処理
const submit = () => {
  form.post(route('user.novels.store'));
};
</script>

<template>
  <FormLayout>
    <HeaderTitle title="小説作成" />
    <form @submit.prevent="submit">
      <InputField label="小説名" v-model="form.title" />
      <SubmitButton>作成</SubmitButton>
      <BackButton />
    </form>
  </FormLayout>
</template>

<style scoped></style>
