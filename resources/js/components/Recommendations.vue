<template>
    <div class="recommendations">
        <!-- Recommendations Header -->
        <div class="mb-4">
            <h2 class="text-lg font-semibold text-white">Recommended</h2>
        </div>

        <!-- Recommendations List -->
        <div class="flex flex-col gap-3">
            <div v-for="video in recommendations" :key="video.id" class="flex cursor-pointer gap-2 rounded-lg p-2 hover:bg-[#272727]">
                <!-- Thumbnail Container -->
                <div class="relative h-[94px] w-[168px] flex-shrink-0">
                    <img :src="video.thumbnail" class="h-full w-full rounded-lg object-cover" />
                    <span class="bg-opacity-80 absolute right-1 bottom-1 rounded bg-black px-1 text-xs text-white">
                        {{ video.duration }}
                    </span>
                </div>

                <!-- Video Info -->
                <div class="flex flex-col gap-1">
                    <h3 class="line-clamp-2 text-sm font-medium text-white">{{ video.title }}</h3>
                    <p class="text-xs text-gray-400">{{ video.channel }}</p>
                    <div class="flex items-center gap-1 text-xs text-gray-400">
                        <span>{{ video.views }}</span>
                        <span>•</span>
                        <span>{{ video.timestamp }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

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
        thumbnail: 'https://picsum.photos/seed/2/320/180',
        title: 'Top 10 Supercars of the Year',
        channel: 'Supercar Reviews',
        views: '856K views',
        timestamp: '1 week ago',
        duration: '15:45',
    },
    {
        id: 3,
        thumbnail: 'https://picsum.photos/seed/3/320/180',
        title: 'Luxury Car Showcase 2024',
        channel: 'Luxury Motors',
        views: '2.1M views',
        timestamp: '3 days ago',
        duration: '18:22',
    },
    {
        id: 4,
        thumbnail: 'https://picsum.photos/seed/4/320/180',
        title: 'Ferrari vs Lamborghini Comparison',
        channel: 'Car Comparisons',
        views: '3.4M views',
        timestamp: '1 month ago',
        duration: '22:15',
    },
    {
        id: 5,
        thumbnail: 'https://picsum.photos/seed/5/320/180',
        title: 'Electric Supercars of the Future',
        channel: 'Future Cars',
        views: '1.5M views',
        timestamp: '2 weeks ago',
        duration: '14:30',
    },
]);
</script>

<style scoped>
.recommendations {
    max-height: calc(100vh - 100px);
    overflow-y: auto;
    padding-right: 8px;
}

/* Custom scrollbar styling */
.recommendations::-webkit-scrollbar {
    width: 8px;
}

.recommendations::-webkit-scrollbar-track {
    background: transparent;
}

.recommendations::-webkit-scrollbar-thumb {
    background: #888;
    border-radius: 4px;
}

.recommendations::-webkit-scrollbar-thumb:hover {
    background: #b40e0e;
}
</style>
