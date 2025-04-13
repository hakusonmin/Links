<script setup>
import BaseLayout from './BaseLayout.vue';
</script>

<template>
  <BaseLayout>
    <section class="content">
      <div class="wrapper">
        <slot name="default" />
      </div>
    </section>
  </BaseLayout>
</template>

<style scoped>
.content {
  background-color: var(--light-gray);
  padding: 20px;
}

.wrapper {
  max-width: 960px;
  margin: 3dvw auto;
  text-align: center;
  padding: 4dvw;
  color: var(--font-black);
}
</style>
