<!-- resources/js/mycomponents/components/User/UserProfileCard.vue -->
<template>
  <div class="m-10 mx-auto flex max-w-[800px] items-center justify-center border-2 border-gray-500 bg-gray-50 p-6">
    <div class="flex items-start gap-6 ">
      <div class="mt-1 flex h-16 w-16 items-center justify-center rounded-md bg-black text-3xl font-bold text-white">
        {{ user.name.charAt(0).toUpperCase() }}
      </div>
      <div>
        <div class="flex text-center">
          <div class="flex text-center text-xl font-bold">
            <div class="w-[120px] line-clamp-1 mx-2 my-auto text-center ">{{ user.name }}</div>
            <div class="w-[150px] mx-2 my-auto text-center">{{ user.followers_count }} Followers</div>
          </div>
          <div class="mx-4 my-2 flex items-center gap-2 text-xl">
            <a v-if="user.github_url" :href="user.github_url" target="_blank">
              <Github class="h-5 w-5 hover:text-black" />
            </a>
            <a v-if="user.x_url" :href="user.x_url" target="_blank">
              <Twitter class="h-5 w-5 hover:text-black" />
            </a>
            <a v-if="user.another_url" :href="user.another_url" target="_blank">
              <LinkIcon class="h-5 w-5 hover:text-black" />
            </a>
          </div>
        </div>
        <div class="max-w-[380px] line-clamp-3 mx-3 whitespace-pre-line text-sm text-left">
          {{ user.profile_text }}
        </div>
      </div>
    </div>
    <!-- 条件分岐：自分なら編集ボタン、他人ならフォロー -->
    <div class="mb-14 ml-1">
      <Link v-if="isOwnProfile" :href="route('mypage.profile.edit')" class="bg-black px-4 py-1.5 font-bold text-white">
        プロフィールを編集
      </Link>
      <FollowButton v-else :user="user" />
    </div>
  </div>
</template>

<script setup>
import { Link, usePage } from '@inertiajs/vue3';
import { Github, Link as LinkIcon, Twitter } from 'lucide-vue-next';
import FollowButton from '../Follows/FollowButton.vue';

const props = defineProps({
  user: Object, // 表示中のプロフィールユーザー
});

// ログイン中のユーザーを取得
const page = usePage();
const authUser = page.props.auth?.user;

// 同一ユーザーか判定
const isOwnProfile = authUser?.id === props.user.id;
</script>
