<script setup lang="ts">
import AuthLayout from '@/layouts/auth/AuthSimpleLayout.vue';
import BaseLayout from '@/mycomponents/layouts/BaseLayout.vue';

defineProps<{
  title?: string;
  description?: string;
}>();
</script>

<template>
  <BaseLayout>
    <AuthLayout :title="title" :description="description">
      <slot />
    </AuthLayout>
  </BaseLayout>
</template>
