<script setup>
import { onMounted } from 'vue';
import FlashMessage from '../components/Messages/FlashMessage.vue';
import ValidationErrors from '../components/Messages/ValidationErrors.vue';
import LayoutHeader from './Style/LayoutHeader.vue';
import LayoutFooter from './Style/LayoutFooter.vue';

onMounted(() => {
  document.documentElement.classList.remove('dark');
});
</script>

<template>
  <div>
    <LayoutHeader />

    <div class="line"></div>

    <div class="main-wrapper">
      <FlashMessage />
      <ValidationErrors />
      <slot />
    </div>

  </div>
</template>

<style scoped>
.main-wrapper {
  width: 100%;
  background-color: rgb(233, 229, 222);
  min-height: 65vh;
}

.line {
  height: 40px;
  background-color: rgb(129, 129, 129);
}
</style>
