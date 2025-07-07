<script setup lang="ts">
import { ref } from 'vue';

// Mock data for recommendations
const recommendations = ref([
    {
        id: 1,
        thumbnail: 'https://picsum.photos/seed/1/320/180',
        title: 'Amazing Car Collection 2024',
        channel: 'Car Enthusiasts',
        views: '1.2M views',
        timestamp: '2 days ago',
        duration: '12:34',
    },
    {
        id: 2,
        thumbnail: 'https://picsum.photos/seed/1/320/180',
        title: 'Amazing Car Collection 2024',
        channel: 'Car Enthusiasts',
        views: '1.2M views',
        timestamp: '2 days ago',
        duration: '12:34',
    },
    {
        id: 3,
        thumbnail: 'https://picsum.photos/seed/1/320/180',
        title: 'Amazing Car Collection 2024',
        channel: 'Car Enthusiasts',
        views: '1.2M views',
        timestamp: '2 days ago',
        duration: '12:34',
    },
    {
        id: 4,
        thumbnail: 'https://picsum.photos/seed/1/320/180',
        title: 'Amazing Car Collection 2024',
        channel: 'Car Enthusiasts',
        views: '1.2M views',
        timestamp: '2 days ago',
        duration: '12:34',
    },
    {
        id: 5,
        thumbnail: 'https://picsum.photos/seed/1/320/180',
        title: 'Amazing Car Collection 2024',
        channel: 'Car Enthusiasts',
        views: '1.2M views',
        timestamp: '2 days ago',
        duration: '12:34',
    },
]);
</script>

<template>
    <div class="recommendations ">
        <!-- Recommendations Header -->
        <div class="mb-4">
            <h2 class="text-lg font-semibold text-white">Recommended</h2>
        </div>

        <!-- Recommendations List -->
        <div class="grid grid-cols-1 gap-3 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-3 xl:grid-cols-1 2xl:grid-cols-1 xl:w-[450px]">
            <div
                v-for="video in recommendations"
                :key="video.id"
                class="lg:flex-start mx-auto flex w-[600px] max-w-full cursor-pointer flex-col gap-2 rounded-lg p-2 hover:bg-[#272727] xl:flex-row"
            >
                <!-- Thumbnail Container -->
                <div class="relative mx-auto w-full flex-shrink-0 xl:h-[94px] xl:w-[168px]">
                    <img :src="video.thumbnail" class="h-full w-full rounded-lg object-cover" />
                    <span class="bg-opacity-80 absolute right-1 bottom-1 rounded bg-black px-1 text-xs text-white">
                        {{ video.duration }}
                    </span>
                </div>

                <!-- Video Info -->
                <div class="flex w-full flex-col gap-1 text-left">
                    <h3 class="line-clamp-2 text-sm font-medium text-white">{{ video.title }}</h3>
                    <p class="cursor-pointer text-xs text-gray-400 transition-colors duration-150 hover:text-white">{{ video.channel }}</p>
                    <div class="flex items-center justify-start gap-1 text-xs text-gray-400">
                        <span>{{ video.views }}</span>
                        <span>•</span>
                        <span>{{ video.timestamp }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
