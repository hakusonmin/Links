<script setup>
import MarkdownIt from 'markdown-it';
import { ref, watch } from 'vue';

const props = defineProps({
  form: Object,
  onSubmit: Function,
  submitLabel: {
    type: String,
    default: '投稿する',
  },
});

const md = new MarkdownIt();
const preview = ref('');

watch(
  () => props.form.content,
  (newVal) => {
    preview.value = md.render(newVal);
  },
  { immediate: true },
);

const addGenre = () => {
  if (props.form.genres.length < 3) {
    props.form.genres.push('');
  }
};

const removeGenre = (index) => {
  props.form.genres.splice(index, 1);
};

const addLink = () => {
  if (props.form.links.length < 5) {
    props.form.links.push({ title: '', link_url: '' });
  }
};

const removeLink = (index) => {
  props.form.links.splice(index, 1);
};
</script>

<template>
  <div>
    <div class="mb-4">
      <label class="mb-1 block font-bold">タイトル（50字以内）</label>
      <input v-model="form.title" class="w-full border-2 border-borderColor p-2 font-bold" placeholder="タイトル" maxlength="50" />
    </div>

    <div class="mb-4">
      <label class="mb-2 block font-bold">ジャンル（10字以内）（3つまで）</label>
      <div v-for="(genre, index) in form.genres" :key="index" class="mb-2 flex gap-2">
        <input v-model="form.genres[index]" class="w-1/3 border-2 border-borderColor p-1 font-bold" placeholder="ジャンル名 " maxlength="10" />
        <button @click="removeGenre(index)" class="bg-black px-4 text-[14px] font-bold text-white">&times;</button>
      </div>
      <button @click="addGenre" class="mt-2 bg-black px-4 py-1 text-[14px] font-bold text-white">ジャンルを追加</button>
    </div>

    <div class="mb-4">
      <label class="mb-1 block font-bold">優先度</label>
      <label><input type="radio" value="high" v-model="form.priority" /> High</label>
      <label><input type="radio" value="middle" v-model="form.priority" class="ml-4" /> Middle</label>
      <label><input type="radio" value="low" v-model="form.priority" class="ml-4" /> Low</label>
    </div>

    <div class="mb-4">
      <label class="mb-2 block font-bold">リンク集とそれに対するコメント（5つまで）</label>

      <div v-for="(link, index) in form.links" :key="index" class="mb-4 flex flex-col gap-2">
        <div class="flex gap-4">
          <input v-model="link.title" class="w-1/3 border-2 border-borderColor p-1 font-bold" placeholder="リンクのタイトル" maxlength="50" />
          <input v-model="link.link_url" class="w-2/3 border-2 border-borderColor p-1" placeholder="https://example.com" />
        </div>

        <!-- コメント + 削除ボタン横並びで -->
        <div class="flex w-full gap-2">
          <textarea
            v-model="link.comment"
            class="min-h-[7rem] w-full resize-none border-2 border-borderColor p-2 text-left align-top"
            placeholder="リンクに対するコメントを書いてみてください"
          ></textarea>

          <button @click="removeLink(index)" class="h-[2rem] my-auto self-start bg-black px-4 text-[14px] font-bold text-white">&times;</button>
        </div>
      </div>

      <button @click="addLink" class="mt-2 bg-black px-4 py-1 text-[14px] font-bold text-white">リンクを追加</button>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
      <div>
        <label class="mb-1 block font-bold">全体に対するコメント</label>
        <textarea v-model="form.content" rows="25" class="w-full border-2 border-borderColor p-2"></textarea>
      </div>
      <div>
        <label class="mb-1 block font-bold">プレビュー</label>
        <div class="prose min-h-[500px] max-w-none border-2 border-borderColor bg-white p-2" v-html="preview"></div>
      </div>
    </div>

    <div class="mt-6 flex justify-center">
      <button @click="onSubmit" class="bg-black px-4 py-2 font-bold text-white">{{ submitLabel }}</button>
    </div>
  </div>
</template>

<style scoped>
.prose :deep(h1),
.prose :deep(h2),
.prose :deep(p) {
  margin: 0.5rem 0;
}
</style>
