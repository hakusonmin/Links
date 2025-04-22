<script setup>
</script>

<template>
  <button class="delete-button">
    <slot />
  </button>
</template>

<style scoped>
.delete-button {
  display: inline-block;
  color: var(--white);
  background-color: var(--black);
  margin: 0 7px 3px 0px;
  padding: 3px 6px 3px 6px;
  font-weight: 80;
  font-size: 13px;
}
</style>
