<script setup>
</script>

<template>
  <button class="delete-button">
    <slot />
  </button>
</template>

<style scoped>
.delete-button {
  margin: 10px;
  padding: 8px 16px;
  color: var(--white);
  background-color: var(--black);
}
</style>
