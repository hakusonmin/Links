<script setup></script>

<template>
  <div v-if="$page.props.flash.status === 'success'" class="message">
    {{ $page.props.flash.message }}
  </div>
  <div v-if="$page.props.flash.status === 'danger'" class="message">
    {{ $page.props.flash.message }}
  </div>
</template>

<style scoped>
.message {
  position: absolute; /* 親要素を基準に絶対配置 */
  top: 200px; /* 上部に配置 */
  left: 50%; /* 左端を中央に */
  transform: translateX(-50%); /* 水平方向に中央寄せ */
  background-color: var(--black); /* 背景色 */
  color: rgb(233, 229, 222); /* 文字色 */
  text-align: center; /* テキスト中央揃え */
  padding: 1rem; /* 内側の余白 */
  border-radius: 8px; /* 角丸 */
  max-width: 400px; /* 幅を30% */
}
</style>
