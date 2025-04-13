<script setup lang="ts">
import BackButton from '@/mycomponents/components/Buttons/BackButton.vue';
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
    <div class="mx-auto max-w-36">
      <BackButton />
    </div>
    <!-- </AppLayout> -->
  </BaseLayout>
</template>
