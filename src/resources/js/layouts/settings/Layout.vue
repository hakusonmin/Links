<script setup lang="ts">
import Heading from '@/components/Heading.vue';
import { Button } from '@/components/ui/button';
import { Separator } from '@/components/ui/separator';
import { type NavItem } from '@/types';
import { Link, usePage } from '@inertiajs/vue3';

const sidebarNavItems: NavItem[] = [
    {
        title: '・アカウント情報',
        href: '/settings/profile',
    },
    {
        title: '・パスワード',
        href: '/settings/password',
    },
    // {
    //     title: 'Appearance',
    //     href: '/settings/appearance',
    // },
];

const page = usePage();

const currentPath = page.props.ziggy?.location ? new URL(page.props.ziggy.location).pathname : '';
</script>

<template>
    <div class="px-4 py-6">
        <!-- <Heading title="Settings" description="Manage your profile and account settings" /> -->

        <!-- 中央揃え対応 -->
        <div class="max-w-[600px] mx-auto flex flex-col space-y-8 md:space-y-0 lg:flex-row lg:space-x-12 lg:space-y-0">
            <aside class="w-full max-w-xl lg:w-48">
                <nav class="flex flex-col space-x-0 space-y-1">
                    <Button
                        v-for="item in sidebarNavItems"
                        :key="item.href"
                        :class="['w-full justify-start', { 'bg-muted': currentPath === item.href }]"
                        as-child
                        class="bg-black text-white font-bold"
                    >
                        <Link :href="item.href">
                            {{ item.title }}
                        </Link>
                    </Button>
                </nav>
            </aside>

            <Separator class="my-6 md:hidden" />

            <div class="w-full">
                <section class="">
                    <slot />
                </section>
            </div>
        </div>
    </div>
</template>
