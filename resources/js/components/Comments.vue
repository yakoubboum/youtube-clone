<script setup lang="ts">
import { ref } from 'vue';

const comments = ref([
    {
        id: 1,
        user: 'John Doe',
        avatar: '/storage/thumbnails/avatar1.jpg',
        text: 'This is a great video! Really enjoyed watching it.',
        likes: 120,
        replies: 5,
        time: '2 days ago',
    },
    {
        id: 2,
        user: 'Jane Smith',
        avatar: '/storage/thumbnails/avatar2.jpg',
        text: 'Thanks for sharing this content. Very informative!',
        likes: 45,
        replies: 2,
        time: '1 day ago',
    },
]);

const newComment = ref('');
</script>

<template>
    <div class="mt-4">
        <!-- Comment Input -->
        <div class="mb-6 flex items-start gap-4">
            <img src="/storage/thumbnails/avatar1.jpg" class="h-10 w-10 rounded-full" alt="User avatar" />
            <div class="flex-1">
                <input
                    v-model="newComment"
                    type="text"
                    placeholder="Add a comment..."
                    class="w-full border-b border-gray-700 bg-transparent pb-2 text-white transition-all duration-300 ease-in-out outline-none focus:border-[#1a73e8]"
                />
            </div>
        </div>

        <!-- Comments List -->
        <div class="space-y-6">
            <div v-for="comment in comments" :key="comment.id" class="flex gap-4">
                <!-- User Avatar -->
                <img :src="comment.avatar" class="h-10 w-10 rounded-full" :alt="comment.user + ' avatar'" />

                <!-- Comment Content -->
                <div class="flex-1">
                    <div class="flex items-center gap-2">
                        <span class="font-medium text-white">{{ comment.user }}</span>
                        <span class="text-sm text-gray-400">{{ comment.time }}</span>
                    </div>
                    <p class="mt-1 text-white">{{ comment.text }}</p>

                    <!-- Comment Actions -->
                    <div class="mt-2 flex items-center gap-4">
                        <button class="flex items-center gap-1 text-gray-400 transition-colors hover:text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path
                                    fill-rule="evenodd"
                                    d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z"
                                    clip-rule="evenodd"
                                />
                            </svg>
                            {{ comment.likes }}
                        </button>
                        <button class="flex items-center gap-1 text-gray-400 transition-colors hover:text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path
                                    fill-rule="evenodd"
                                    d="M18 10c0 3.866-3.582 7-8 7a8.841 8.841 0 01-4.083-.98L2 17l1.338-3.123C2.493 12.767 2 11.434 2 10c0-3.866 3.582-7 8-7s8 3.134 8 7zM7 9H5v2h2V9zm8 0h-2v2h2V9zM9 9h2v2H9V9z"
                                    clip-rule="evenodd"
                                />
                            </svg>
                            {{ comment.replies }}
                        </button>
                        <button class="text-gray-400 transition-colors hover:text-white">Reply</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>
/* Custom scrollbar for the comments section */
.comments-list {
    scrollbar-width: thin;
    scrollbar-color: #4b5563 #1f2937;
}

.comments-list::-webkit-scrollbar {
    width: 8px;
}

.comments-list::-webkit-scrollbar-track {
    background: #1f2937;
}

.comments-list::-webkit-scrollbar-thumb {
    background-color: #4b5563;
    border-radius: 4px;
}
</style>
