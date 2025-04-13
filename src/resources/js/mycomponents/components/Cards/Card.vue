<script setup></script>

<template>
  <div class="card">
    <slot />
  </div>
</template>

<style scoped>
.card {
  margin: 10px;
  max-width: 270px;
  border: 1px solid rgb(130, 130, 130);
  display: grid;
  background-color: var(--white);
  box-shadow: 2px 2px 4px var(--black);
}
</style>

