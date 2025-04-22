<script setup>
import { Link } from '@inertiajs/vue3';
defineProps({ links: Array })
</script>
<template>
    <div v-if="links.length > 3" class="flex justify-center items-center gap-4 mt-8">
        <div class="flex flex-wrap -mb-1">
            <template v-for="(link, index) in links" :key="index">
                <div v-if="link.url === null" class="mr-1 mb-1 px-4 py-3 text-sm leading-4 rounded"
                    v-html="link.label" />
                <Link v-else
                    class="mr-1 mb-1 px-4 py-3 text-sm leading-4 border rounded"
                    :class="{ 'bg-black text-white font-bold': link.active }" :href="link.url" v-html="link.label" />
            </template>
        </div>
    </div>
</template>


