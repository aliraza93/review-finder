<template>
    <Head title="Home" />
    <Main />

    <!-- Content starts here -->
    <!-- Start block -->
    <section class="bg-gray-50 dark:bg-gray-900 p-3 sm:p-5 antialiased">
        <div class="mx-auto max-w-screen-xl px-4 lg:px-12">
            <h1
                class="text-xl sm:text-xl font-bold text-gray-800 dark:text-white"
            >
                Reviews
            </h1>
            <!-- Start coding here -->
            <SearchComponent />
            
        </div>
    </section>
</template>

<script setup>
import { Head } from "@inertiajs/vue3";
import Main from "../Layout/Main.vue";
import SearchComponent from "../Components/SearchComponent.vue";
</script>
