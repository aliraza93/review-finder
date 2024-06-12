<template>
  <div>
    <!-- Header -->
    <header class="bg-gray-800 py-4">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-white text-2xl font-bold">Review Finder</h1>
      </div>
    </header>

    <!-- Page Content -->
    <slot></slot>
  </div>
</template>

<script setup>
import { ref } from 'vue';

const isOpen = ref(false);

const toggleMenu = () => {
  isOpen.value = !isOpen.value;
}

const isActive = (path) => {
  return window.location.pathname === path;
}
</script>
