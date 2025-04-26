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

    <div class="h-10 bg-lineColor"></div>

    <!-- ↓ここのpy-1超大事です marginじゃダメ -->
    <div class="px-1 w-full bg-backgroundColor text-fontBlack">
      <FlashMessage />
      <ValidationErrors />
      <slot />
    </div>

  </div>
</template>

<style scoped>

</style>
