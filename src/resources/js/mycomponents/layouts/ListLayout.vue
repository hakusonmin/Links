<script setup>
import BaseLayout from './BaseLayout.vue';
</script>

<template>
  <BaseLayout>
    <section class="bg-lightGray">
      <div class="max-w-[960px] mx-auto text-center text-fontBlack">
        <slot name="default" />
      </div>
    </section>
  </BaseLayout>
</template>

<style scoped>
</style>
