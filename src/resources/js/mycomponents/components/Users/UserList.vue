<script setup>
const props = defineProps({
  users: {
    type: Array,
    required: true,
  },
});
</script>

<template>
  <div class="wrapper">
    <div
      v-for="user in users"
      :key="user.id"
      class="user-card"
    >
      <img src="/images/Thumbnail.png" />
      <div class="list-text">
        <div class="fuga">
          <div class="flex mx-2 h-5 w-5 items-center justify-center rounded-md bg-black text-xs text-white">
            {{ user.name.charAt(0).toUpperCase() }}
          </div>
          <div class="mx-1">{{ user.name }}</div>
          <div class="mx-1">{{ user.followers }} Likes</div>
        </div>
      </div>
    </div>
  </div>
</template>

<style scoped>
.wrapper {
  max-width: 960px;
  margin: 0 auto;
  display: flex;
  flex-direction: column;
  align-items: center;
}

.user-card {
  box-sizing: border-box;
  width: 485px;
  height: 80px;
  margin: 10px auto;
  border: 2px solid var(--border-color);
  display: flex;
  background-color: var(--white);
  overflow: hidden;
}

.user-card img {
  width: 120px;
  object-fit: cover;
}

.list-text {
  padding: 10px;
  display: flex;
  flex-direction: column;
  justify-content: space-between;
  flex: 1;
  word-break: break-word;
}

.moe {
  text-align: left;
  font-size: 14px;
  font-weight: bold;
}

.fuga {
  text-align: right;
  font-size: 14px;
  font-weight: bold;
  display: flex;
  justify-content: right;
}
</style>
