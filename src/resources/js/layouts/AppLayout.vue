<script setup lang="ts">
import BaseLayout from '@/mycomponents/layouts/BaseLayout.vue';
import type { BreadcrumbItemType } from '@/types';

interface Props {
  breadcrumbs?: BreadcrumbItemType[];
}

withDefaults(defineProps<Props>(), {
  breadcrumbs: () => [],
});
</script>

<template>
  <BaseLayout>
    <!-- <AppLayout :breadcrumbs="breadcrumbs"> -->
    <slot />
    <!-- </AppLayout> -->
  </BaseLayout>
</template>
