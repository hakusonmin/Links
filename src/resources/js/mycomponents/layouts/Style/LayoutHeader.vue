<script setup>
import { Link } from '@inertiajs/vue3';
</script>

<template>
  <header class="flex justify-center bg-black px-[4%] h-[120px]">
    <div class="flex w-full max-w-[960px] items-center justify-between " >
      <h2 class="text-white font-bold text-[30px]">
        <Link href="/">Links</Link>
      </h2>
      <nav>
        <ul class="flex items-center py-2 text-white font-bold text-[20px]">
          <li class="mx-1">
            <Link href="/about">Linksとは？</Link>
          </li>
          <li class="mx-1">
            <Link :href="route('mypage.dashboard')" method="get" class="text-white">ダッシュボード</Link>
          </li>
        </ul>
      </nav>
    </div>
  </header>
</template>
