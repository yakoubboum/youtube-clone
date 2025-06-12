<script setup lang="ts">
import VideoCard from '@/components/VideoCard.vue';
import NavLayout from '@/layouts/NavLayout.vue';
import { Head } from '@inertiajs/vue3';

defineProps<{
    videos: Array<{
        id: number;
        title: string;
        file_path: string;
        thumbnail_path: string;
        views: number;
        user: {
            name: string;
        };
    }>;
}>();
</script>

<template>
    <Head title="Home"></Head>

    <NavLayout>
        <div>
            <div class="grid sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-3 xl:grid-cols-4 2xl:grid-cols-4">
                <div v-for="video in videos" :key="video.id">
                    <VideoCard
                        :id="video.id"
                        :title="video.title"
                        :user="video.user.name"
                        :views="video.views"
                        :image="`/storage/thumbnails/avatar${video.id}.jpg`"
                        :videoUrl="video.file_path"
                        :thumbnail="video.thumbnail_path"
                    />
                </div>
            </div>
        </div>
    </NavLayout>
</template>
