<template>
  <div class="text-xl font-semibold mb-4">{{ title }}</div>
</template>

<script setup>
import { defineProps } from 'vue';

const props = defineProps({
  title: {
    type: String,
  },
});
</script>

<style scoped></style>
