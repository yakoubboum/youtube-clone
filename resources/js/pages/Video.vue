<script setup lang="ts">
import Comments from '@/components/Comments.vue';
import Recommendations from '@/components/Recommendations.vue';
import VideoPlayer2 from '@/components/VideoPlayer2.vue';
import NavLayout from '@/layouts/NavLayout.vue';
import CheckCircle from 'vue-material-design-icons/CheckCircle.vue';

defineProps<{
    video: {
        id: number;
        title: string;
        description: string;
        file_path: string;
        thumbnail_path: string;
        views: number;
        created_at: string;
        likes: number;
        visibility: string;
        user: {
            id: number;
            name: string;
        };
    };
}>();
</script>

<template>
    <NavLayout>
        <div class="p-3">
            <!-- Main Content and Recommendations Container -->
            <div class="flex items-start justify-between gap-6">
                <!-- Main Content -->
                <div class="relative mx-auto ml-[100px] flex w-[60%] max-w-[1000px] flex-col items-center">
                    <!-- Video Player -->
                    <div class="w-full">
                        <VideoPlayer2 :video="video" />
                    </div>

                    <!-- Video Info -->
                    <div class="mt-4 w-full">
                        <h1 class="text-2xl font-bold text-white">{{ video.title }}</h1>

                        <!-- Video Stats and Actions -->
                        <div class="mt-2 flex items-center justify-between">
                            <div class="flex items-center gap-4">
                                <div class="flex items-center">
                                    <img
                                        class="h-10 w-10 rounded-full"
                                        :src="`https://picsum.photos/id/${(Math.random() * 100).toFixed(0)}/100` || ''"
                                    />
                                    <div class="ml-3">
                                        <div class="flex items-center text-lg font-semibold text-white">
                                            yb <CheckCircle class="ml-1" fillColor="#888888" :size="17" />
                                        </div>
                                        <div class="text-sm text-gray-400">100 K subscribers</div>
                                    </div>
                                </div>
                                <button class="rounded-full bg-white px-4 py-2 font-semibold text-black hover:bg-gray-200">Subscribe</button>
                            </div>

                            <!-- Video Actions -->
                            <div class="flex items-center gap-2">
                                <button class="flex items-center gap-2 rounded-full bg-[#272727] px-4 py-2 text-white hover:bg-[#3f3f3f]">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                        <path
                                            fill-rule="evenodd"
                                            d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z"
                                            clip-rule="evenodd"
                                        />
                                    </svg>
                                    Like
                                </button>
                                <button class="flex items-center gap-2 rounded-full bg-[#272727] px-4 py-2 text-white hover:bg-[#3f3f3f]">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                        <path
                                            fill-rule="evenodd"
                                            d="M18 10c0 3.866-3.582 7-8 7a8.841 8.841 0 01-4.083-.98L2 17l1.338-3.123C2.493 12.767 2 11.434 2 10c0-3.866 3.582-7 8-7s8 3.134 8 7zM7 9H5v2h2V9zm8 0h-2v2h2V9zM9 9h2v2H9V9z"
                                            clip-rule="evenodd"
                                        />
                                    </svg>
                                    Share
                                </button>
                            </div>
                        </div>

                        <!-- Video Description -->
                        <div class="mt-4 rounded-xl bg-[#272727] p-4">
                            <div class="flex items-center gap-2">
                                <span class="text-sm text-gray-400">100 K views</span>
                                <span class="text-sm text-gray-400">•</span>
                                <span class="text-sm text-gray-400">2 days ago</span>
                            </div>
                            <p class="mt-2 text-white">Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, quos.</p>
                        </div>
                    </div>

                    <!-- Comments Section -->
                    <div class="mt-8 w-full">
                        <Comments />
                    </div>
                </div>

                <!-- Recommendations Sidebar -->
                <div class="hidden w-[400px] flex-shrink-0 sm:block">
                    <Recommendations />
                </div>
            </div>
        </div>
    </NavLayout>
</template>
