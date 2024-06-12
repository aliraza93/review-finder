<template>
    <div>
        <div
            class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg overflow-hidden mt-3"
        >
            <div
                class="p-4 m-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400"
                role="alert"
                v-if="successMessage"
            >
                <span class="font-medium">Success alert!</span>
                {{ successMessage }}
            </div>
            <!-- Search Form -->
            <form
                class="flex items-center max-w-[45rem] w-full mx-auto p-16"
                action="#"
                @submit.prevent="searchReviews"
            >
                <label for="simple-search" class="sr-only">Search</label>
                <div class="relative w-full">
                    <div
                        class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none"
                    >
                        <svg
                            :class="
                                'w-4 h-4 text-gray-500 dark:text-gray-400 ' +
                                (errors.query ? 'mb-5' : '')
                            "
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
                        :class="{
                            'bg-red-50 border border-red-500 text-red-900 placeholder-red-700 text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block dark:bg-gray-700 dark:text-red-500 dark:placeholder-red-500 dark:border-red-500 w-full ps-10 p-2.5':
                                errors.query,
                            'bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500':
                                !errors.query,
                        }"
                        placeholder="Type property url here..."
                        v-model="query"
                    />
                    <p
                        v-if="errors?.query"
                        class="text-sm text-red-600 dark:text-red-500"
                    >
                        <span class="font-medium">Oops!</span>
                        {{ errors.query[0] }}
                    </p>
                </div>
                <button
                    :disabled="isLoading"
                    type="submit"
                    :class="
                        'p-2.5 ms-2 text-sm font-medium text-white bg-blue-700 rounded-lg border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 ' +
                        (errors.query ? 'mb-5' : '')
                    "
                >
                    <template v-if="isLoading">
                        <svg
                            aria-hidden="true"
                            role="status"
                            class="inline w-4 h-4 me-3 text-white animate-spin"
                            viewBox="0 0 100 101"
                            fill="none"
                            xmlns="http://www.w3.org/2000/svg"
                        >
                            <path
                                d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                                fill="#E5E7EB"
                            />
                            <path
                                d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                                fill="currentColor"
                            />
                        </svg>
                        Searching...
                    </template>
                    <template v-else>
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
                    </template>
                    <span class="sr-only">Search</span>
                </button>
            </form>
        </div>

        <!-- Reviews -->
        <Reviews
            v-if="reviews.length > 0"
            :metaData="metaData"
            :reviews="reviews"
        />

        <!-- No Reviews Message -->
        <div class="max-w-8xl mx-auto bg-white dark:bg-gray-800 mt-5">
            <div
                class="grid grid-cols-2 sm:grid-cols-2 lg:grid-cols-3 gap-4 items-start grid-auto-rows:min-content"
            >
                <div
                    v-if="reviews.length === 0"
                    class="col-span-full text-center py-10"
                >
                    <p class="text-gray-700">
                        {{ requestSent ? 'No reviews found for this listing.' : 'Type a url above to search for the reviews.' }}
                    </p>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref } from "vue";
import Reviews from "../Components/Reviews.vue";

const query = ref("");

const errors = ref({});

const isLoading = ref(false);
const disabled = ref(false);

const successMessage = ref("");


const reviews = ref([]);
const metaData = ref({});

const requestSent = ref(false)

const searchReviews = async () => {
    isLoading.value = true;
    reviews.value = [];
    metaData.value = {};
    try {
        const response = await axios.get(`/reviews/?url=${query.value}`);

        // Clear errors after successful submission
        errors.value = {};

        if (response.status === 200) {
            successMessage.value = "Reviews fetched successfully!";
            requestSent.value = true
            // Assign reviews and metadata
            reviews.value = response.data.data.reviews;
            metaData.value = response.data.data.metadata;
        }

        setTimeout(() => {
            successMessage.value = null;
        }, 3000);
    } catch (err) {
        if (err.response && err.response.status === 422) {
            errors.value = err.response.data.errors;
        } else {
            console.error("An error occurred:", err.message);
        }
    } finally {
        isLoading.value = false;
    }
};
</script>
