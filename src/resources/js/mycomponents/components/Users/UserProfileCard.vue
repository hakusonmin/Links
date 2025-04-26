<!-- resources/js/mycomponents/components/User/UserProfileCard.vue -->
<template>
  <div class="m-10 mx-auto flex max-w-[800px] items-center justify-center border-2 border-gray-500 bg-gray-50 p-6">
    <div class="flex flex-col items-center gap-6 md:flex-row md:items-start">
      <div class="mt-1 flex h-16 w-16 items-center justify-center rounded-md bg-black text-3xl font-bold text-white">
        {{ user.name.charAt(0).toUpperCase() }}
      </div>
      <div>
        <div>
          <div class="flex h-[30px] justify-between text-xl font-bold mb-0.5">
            <div class="mx-2 line-clamp-1 w-[150px] text-left">
              {{ user.name }}
            </div>
            <!-- 条件分岐：自分なら編集ボタン、他人ならフォロー -->
            <div>
              <Link v-if="isOwnProfile" :href="route('mypage.profile.edit')" class="bg-black px-3.5 py-1.5 text-[14px] font-bold text-white">
                編集する
              </Link>
              <FollowButton v-else :user="user" />
            </div>
          </div>
          <div class="mx-3 mb-0.5 line-clamp-3 max-w-[380px] whitespace-pre-line text-left text-sm">
            {{ user.profile_text }}
          </div>

          <div class="flex h-[20px] justify-end">
            <div class="w-[120px] text-left font-bold">{{ user.followers_count }} Followers</div>
            <div>
              <div class="mx-2 flex items-center gap-2 text-xl ">
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
          </div>
        </div>
      </div>
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
