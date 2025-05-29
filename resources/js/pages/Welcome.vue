<script setup lang="ts">
import VideoCard from '@/components/VideoCard.vue';
import NavLayout from '@/layouts/NavLayout.vue';
import { Head } from '@inertiajs/vue3';

const videos = [
    {
        id: 1,
        title: 'Video 1',
        user: 'John Doe',
        views: '100',
        video: '/storage/videos/Car.mp4',
        thumbnail: '/storage/thumbnails/Car.png',
    },
    {
        id: 1,
        title: 'Video 1',
        user: 'John Doe',
        views: '100',
        video: '/storage/videos/Car.mp4',
        thumbnail: '/storage/thumbnails/Car.png',
    },
    
];
</script>

<template>
    <Head title="Home"></Head>

    <NavLayout>
        <div>
            <div class="grid sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-3 xl:grid-cols-4 2xl:grid-cols-5">
                <div v-for="video in videos" :key="video.id">
                    <VideoCard
                        :title="video.title"
                        :user="video.user"
                        :views="video.views"
                        :image="`/storage/thumbnails/avatar${video.id}.jpg`"
                        :videoUrl="video.video"
                        :thumbnail="video.thumbnail"
                    />
                </div>
            </div>
        </div>
    </NavLayout>

</template>

<style>
html {
    background-color: #0f0f0f;
}
</style>
