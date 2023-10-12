<template>
  <Header></Header>
  <main class="p-5">
    <router-view />
  </main>
  <hr />
</template>

<script setup>
import Header from './components/header.vue';
</script>
