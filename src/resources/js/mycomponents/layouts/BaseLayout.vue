<script setup>
import FlashMessage from '../components/Messages/FlashMessage.vue';
import ValidationErrors from '../components/Messages/ValidationErrors.vue';
import { usePage } from '@inertiajs/vue3';
import { computed } from "vue";
import LayoutHeader from './Style/LayoutHeader.vue';
import LayoutHeaderGuest from './Style/LayoutHeaderGuest.vue';

const page = usePage();
const isLoggedIn = computed(() => !!page.props.auth.user);
</script>

<template>
  <div>
    <component :is="isLoggedIn ? LayoutHeader : LayoutHeaderGuest" />

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
}

.line {
  height: 40px;
  background-color: rgb(129, 129, 129);
}
</style>
