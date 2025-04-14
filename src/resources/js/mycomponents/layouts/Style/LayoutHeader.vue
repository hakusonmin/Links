<!-- LayoutHeader.vue -->
<script setup>
import { Link } from '@inertiajs/vue3';
</script>

<template>
  <header>
    <div class="header-container">
      <h2 class="site-title">
        <Link href="/" >Links</Link>
      </h2>
      <nav>
        <ul>
          <li>
            <Link href="/about">Linksとは？</Link>
          </li>
          <li>
            <Link :href="route('mypage.dashboard')" method="get" class="link">マイページ</Link>
          </li>
          <li>
            <Link :href="route('logout')" method="post" class="link">ログアウト</Link>
          </li>
        </ul>
      </nav>
    </div>
  </header>
</template>

<style scoped>
header {
  display: flex;
  justify-content: center;
  background-color: var(--black);
  padding: 0 4%;
  height: 120px;
}

.header-container {
  display: flex;
  align-items: center;
  justify-content: space-between;
  max-width: 960px;
  width: 100%;
}

.site-title a {
  color: var(--white);
  font-weight: bold;
  font-size: 30px;
}

nav ul {
  display: flex;
  padding: 10px 0;
  align-items: center;
}

nav ul li {
  font-size: 20px;
  font-weight: bold;
  margin-left: 2.4dvw;
  list-style: none;
}

nav ul li a {
  color: var(--white);
}

.link {
  color: var(--white);
}

@media screen and (max-width: 600px) {
  .site-title {
    margin-top: 20px;
  }

  header {
    flex-direction: column;
    height: auto;
  }
}
</style>
