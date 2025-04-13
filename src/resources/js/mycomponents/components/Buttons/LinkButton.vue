<script setup>
import { Link } from '@inertiajs/vue3';
</script>

<template>
  <Link class="button" as="button">
    <slot />
  </Link>
</template>

<style scoped>
.button {
  margin: 10px;
  padding: 8px 16px;
  color: var(--white);
  background-color: var(--black);
}
</style>
