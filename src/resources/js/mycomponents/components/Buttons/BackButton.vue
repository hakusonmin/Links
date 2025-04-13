<!-- components/BackButton.vue -->
<template>
    <button @click="goBack" :class="buttonClass">
      <slot>戻る</slot>
    </button>
  </template>

  <script setup>
  import { computed } from 'vue';

  // ボタンの見た目をカスタマイズしたい場合は、クラスを props で受け取る
  const props = defineProps({
    class: {
      type: String,
      default: 'back-button'
    }
  });

  const buttonClass = computed(() => props.class);

  function goBack() {
    if (window.history.length > 1) {
      history.back();
    } else {
      // 前のページがない場合はデフォルトでホームに戻す (必要に応じて変更)
      window.location.href = '/';
    }
  }
  </script>

  <style scoped>
  .back-button {
    appearance: none;
    margin: 10px;
    padding: 8px 16px;
    color: var(--white);
    background-color: var(--black);
  }

  </style>
