<script setup>

</script>

<template>
  <div class="card-wrapper">
    <slot />
  </div>
</template>

<style scoped>
.card-wrapper {
  margin-top: 30px;
  display: grid;
  gap: 20px; /*これdvwで指定するとレスデザで上下間が詰まりすぎるからpxにした*/
  grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
  place-items: center; /* これで中央揃えになる */
}
</style>
