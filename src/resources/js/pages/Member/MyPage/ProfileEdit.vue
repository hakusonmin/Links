<script setup>
import BaseLayout from '@/mycomponents/layouts/BaseLayout.vue';
import { useForm } from '@inertiajs/vue3';

const props = defineProps({
  user: Object,
});

const form = useForm({
  profile_text: props.user.profile_text || '',
  github_url: props.user.github_url || '',
  x_url: props.user.x_url || '',
  another_url: props.user.another_url || '',
});

const submit = () => {
  form.put(route('mypage.profile.update'));
};
</script>

<template>
  <BaseLayout>
    <div class="mx-auto mt-10 max-w-[960px]">
      <div class="mb-6 text-xk font-bold">プロフィール編集画面</div>

      <form @submit.prevent="submit" class="space-y-6">
        <div>
          <label class="mb-1 block font-semibold">プロフィール文 (100字以内)</label>
          <textarea v-model="form.profile_text" rows="4" class="w-full border-2 border-borderColor p-2" maxlength="100"></textarea>
        </div>

        <div>
          <label class="mb-1 block font-semibold">github url</label>
          <input type="url" v-model="form.github_url" class="w-full border-2 border-borderColor p-2" />
        </div>

        <div>
          <label class="mb-1 block font-semibold">X(旧ツイッター) url</label>
          <input type="url" v-model="form.x_url" class="w-full border-2 border-borderColor p-2" />
        </div>

        <div>
          <label class="mb-1 block font-semibold">その他のurl</label>
          <input type="url" v-model="form.another_url" class="w-full border-2 border-borderColor p-2" />
        </div>

        <div class="text-center">
          <button type="submit" class="bg-black px-4 py-1.5 text-white font-bold " :disabled="form.processing">更新する</button>
        </div>
      </form>
    </div>
  </BaseLayout>
</template>
