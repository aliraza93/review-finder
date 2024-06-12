<template>
    <div class="max-w-8xl mx-auto bg-white dark:bg-gray-800 mt-5">
        <div
            class="grid grid-cols-2 sm:grid-cols-2 lg:grid-cols-3 gap-4 items-start grid-auto-rows:min-content"
        >
            <!-- Rating Profile -->
            <div
                v-for="review in reviews"
                :key="review.id"
                class="bg-white rounded-lg shadow-md overflow-hidden mb-4 grid gap-4"
            >
                <div class="p-6 h-auto max-w-full rounded-lg">
                    <div class="flex items-center mb-4">
                        <img
                            :src="review.reviewer.pictureUrl"
                            alt="Reviewer"
                            class="w-8 h-8 rounded-full mr-2"
                        />
                        <div>
                            <h3 class="text-lg font-semibold text-gray-800">
                                {{ review.reviewer.firstName }}
                            </h3>
                            <p class="text-gray-600 text-sm">
                                {{ review.localizedReviewerLocation }}
                            </p>
                        </div>
                    </div>
                    <!-- Dynamic star rating -->
                    <div class="flex items-center mb-4">
                        <!-- Loop to generate filled star icons based on rating -->
                        <template v-for="n in review.rating" :key="n">
                            <span class="text-yellow-400">
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    class="h-6 w-6 fill-current"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        d="M12 2c-.3 0-.6.1-.8.4l-3.7 6.3-7.1 1.1c-.4.1-.6.6-.4 1l5.4 5.3-1.3 7c-.1.4.3.8.7.6l6.7-3.5 6.7 3.5c.4.2.8-.2.7-.6l-1.3-7 5.4-5.3c.2-.4 0-.9-.4-1l-7.1-1.1-3.7-6.3c-.2-.3-.5-.4-.8-.4z"
                                    />
                                </svg>
                            </span>
                        </template>
                        <!-- Display numeric rating -->
                        <span class="text-gray-600 ml-2 mt-1">{{
                            review.rating
                        }}</span>
                    </div>
                    <p
                        :class="{
                            'truncate-3-lines': !review.showFull,
                            '': review.showFull,
                        }"
                        class="text-gray-700 mb-4"
                    >
                        "{{ review.comments }}"
                    </p>
                    <button
                        v-if="review.comments.length > 3 * 20"
                        @click="review.showFull = !review.showFull"
                        class="text-blue-500"
                    >
                        {{ review.showFull ? "View Less" : "View More" }}
                    </button>
                    <div
                        class="flex items-center text-gray-600 text-sm mt-auto"
                    >
                        <span class="ml-auto">
                            <i class="far fa-calendar-alt mr-1"></i
                            >{{ review.localizedDate }}
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref } from "vue";

defineProps({
    reviews: {
        type: Array,
    },
    metaData: {
        type: Object,
    },
});

const showFull = ref(false);
</script>

<style scoped>
.truncate-3-lines {
    overflow: hidden;
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
}
</style>
