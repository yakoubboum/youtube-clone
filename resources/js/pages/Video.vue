<script setup lang="ts">
import Comments from '@/components/Comments.vue';
import Recommendations from '@/components/Recommendations.vue';
import VideoPlayer2 from '@/components/VideoPlayer2.vue';
import NavLayout from '@/layouts/NavLayout.vue';
import { ref } from 'vue';
import CheckCircle from 'vue-material-design-icons/CheckCircle.vue';

import dislikeIcon1 from '@/assets/icons/dislike1.svg';
import likeIcon1 from '@/assets/icons/like1.svg';

import dislikeIcon0 from '@/assets/icons/dislike0.svg';
import likeIcon0 from '@/assets/icons/like0.svg';
import shareIcon from '@/assets/icons/share.svg';
import threedots from '@/assets/icons/threedots.svg';

const liked = ref(false);
const disliked = ref(false);

const toggleLike = () => {
    liked.value = !liked.value;
    if (liked.value) {
        disliked.value = false;
    }
};

const toggleDislike = () => {
    disliked.value = !disliked.value;
    if (disliked.value) {
        liked.value = false;
    }
};

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
        <div class="bg-[#0f0f0f] p-3">
            <!-- Main Content and Recommendations Container -->
            <div class="ml-[100px] flex max-w-screen-2xl items-start gap-x-8 p-6">
                <!-- Main Content -->
                <div class="flex w-full max-w-4xl flex-col items-center lg:w-8/12">
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
                                        :src="`https://picsum.photos/id/100/100` || ''"
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
                                <div class="flex items-center rounded-full bg-[#272727] text-white">
                                    <button @click="toggleLike" class="flex items-center gap-2 rounded-l-full px-4 py-2 hover:bg-[#3f3f3f]">
                                        <img v-if="liked" :src="likeIcon1" />
                                        <img v-else :src="likeIcon0" />
                                        <span>Like</span>
                                    </button>
                                    <div class="h-6 w-px bg-gray-600"></div>
                                    <button @click="toggleDislike" class="flex items-center rounded-r-full px-4 py-2 hover:bg-[#3f3f3f]">
                                        <img v-if="disliked" :src="dislikeIcon1" />
                                        <img v-else :src="dislikeIcon0" />
                                    </button>
                                </div>
                                <button class="flex items-center gap-2 rounded-full bg-[#272727] px-4 py-2 text-white hover:bg-[#3f3f3f]">
                                    <img :src="shareIcon">
                                    Share
                                </button>
                                <button class="flex items-center rounded-full bg-[#272727] p-2 text-white hover:bg-[#3f3f3f]">
                                    <img :src="threedots">
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
