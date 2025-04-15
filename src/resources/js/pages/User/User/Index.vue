<script setup>
import CardTitle from '@/components/ui/card/CardTitle.vue';
import CardLink from '@/mycomponents/components/Buttons/CardLink.vue';
import Card from '@/mycomponents/components/Cards/Card.vue';
import CardContainer from '@/mycomponents/components/Cards/CardContainer.vue';
import CardImage from '@/mycomponents/components/Cards/CardImage.vue';
import HeaderTitle from '@/mycomponents/components/Styles/HeaderTitle.vue';
import ListLayout from '@/mycomponents/layouts/ListLayout.vue';
</script>

<template>
  <ListLayout>
    <HeaderTitle title="ユーザー管理ページ" />
    <CardContainer>
      <Card>
        <CardLink as="a" :href="route('profile.edit')">
          <CardImage src="/images/Thumbnail.png" />
          <CardTitle class="text-[16px] font-medium">アカウント情報</CardTitle>
        </CardLink>
      </Card>
      <Card>
        <CardLink as="a" :href="route('user.novels.index')">
          <CardImage src="/images/Thumbnail.png" />
          <CardTitle class="text-[16px] font-medium">小説一覧画面へ</CardTitle>
        </CardLink>
      </Card>
    </CardContainer>
  </ListLayout>
</template>

