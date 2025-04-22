<script setup>
import { Link } from '@inertiajs/vue3';

</script>

<template>
  <Link class="edit-button">
    <slot />
  </Link>
</template>

<style scoped>
.edit-button {
  display: inline-block;
  color: var(--white);
  background-color: var(--black);
  margin: 0 7px 3px 0px;
  padding: 3px 6px 3px 6px;
  font-weight: 80;
  font-size: 13px;
}
</style>

