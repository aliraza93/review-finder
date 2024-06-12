<template>
    <form class="flex items-center max-w-[45rem] w-full mx-auto p-16">
        <label for="simple-search" class="sr-only">Search</label>
        <div class="relative w-full">
            <div
                class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none"
            >
                <svg
                    class="w-4 h-4 text-gray-500 dark:text-gray-400"
                    aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M8 11V5.414a1 1 0 0 1 .293-.707l7-7a1 1 0 0 1 1.414 0l7 7a1 1 0 0 1 0 1.414L15.707 12H8zM21 21a2 2 0 0 0-2-2h-2v-5.586a1 1 0 0 0-.293-.707l-7-7A1 1 0 0 0 8 4.414V10H5a2 2 0 0 0-2 2v7a2 2 0 0 0 2 2h14zM14 10h7M18.5 16.5l3 3M3 8h4M5 20h4"
                    />
                </svg>
            </div>
            <input
                type="text"
                id="simple-search"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder="Type property url here..."
                required
            />
        </div>
        <button
            type="submit"
            class="p-2.5 ms-2 text-sm font-medium text-white bg-blue-700 rounded-lg border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
        >
            <svg
                class="w-4 h-4"
                aria-hidden="true"
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 20 20"
            >
                <path
                    stroke="currentColor"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"
                />
            </svg>
            <span class="sr-only">Search</span>
        </button>
    </form>
</template>

<script setup></script>
