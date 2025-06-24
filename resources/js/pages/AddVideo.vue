<script setup lang="ts">
import AddVideo from '@/components/AddVideo.vue';
import NavLayout from '@/layouts/NavLayout.vue';
import { Head, router } from '@inertiajs/vue3';
import { ref } from 'vue';

const showPopup = ref(false);

defineProps<{
    videos: Array<{
        id: number;
        title: string;
        file_path: string;
        thumbnail_path: string;
        views: number;
        likes: number;
        visibility: string;
        created_at: string;
    }>;
}>();

const deleteVideo = (id: number) => {
    if (confirm('Are you sure you want to delete this video?')) {
        router.delete(`/video/${id}`, {
            onSuccess: () => {
                // The page will automatically refresh with the updated videos list
            },
            onError: (errors) => {
                alert('Failed to delete video: ' + (errors.message || 'Unknown error'));
            },
        });
    }
};
</script>

<template>
    <Head title="Add Video"></Head>

    <NavLayout>
        <!-- Overlay -->
        <div v-if="showPopup" class="fixed inset-0 z-50 bg-black/50"></div>

        <!-- Main Content -->
        <div class="w-full bg-[#282828] p-3">
            <AddVideo v-model:showPopup="showPopup" />

            <div class="mt-4">
                <table class="w-full border-t-[0.5px] border-b-[0.5px] border-gray-300">
                    <thead>
                        <tr>
                            <th class="w-[300px] border-b-[0.5px] border-gray-300 p-2 text-white">video</th>
                            <th class="border-b-[0.5px] border-gray-300 p-2 text-white">visibility</th>
                            <th class="border-b-[0.5px] border-gray-300 p-2 text-white">date</th>
                            <th class="border-b-[0.5px] border-gray-300 p-2 text-white">views</th>
                            <th class="border-b-[0.5px] border-gray-300 p-2 text-white">likes</th>
                            <th class="border-b-[0.5px] border-gray-300 p-2 text-white">actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="video in videos" :key="video.id">
                            <td class="h-[200px] w-[300px] border-b-[0.5px] border-gray-300 p-2 align-middle text-white">
                                <div class="flex h-full flex-col items-center justify-center">
                                    <img :src="`/storage/${video.thumbnail_path}`" alt="" class="mb-2 object-cover" />
                                    <p class="text-white">{{ video.title }}</p>
                                </div>
                            </td>
                            <td class="border-b-[0.5px] border-gray-300 p-2 align-middle text-white">
                                <div class="flex h-full items-center justify-center">{{ video.visibility }}</div>
                            </td>
                            <td class="border-b-[0.5px] border-gray-300 p-2 align-middle text-white">
                                <div class="flex h-full items-center justify-center">{{ video.created_at }}</div>
                            </td>
                            <td class="border-b-[0.5px] border-gray-300 p-2 align-middle text-white">
                                <div class="flex h-full items-center justify-center">{{ video.views }}</div>
                            </td>
                            <td class="border-b-[0.5px] border-gray-300 p-2 align-middle text-white">
                                <div class="flex h-full items-center justify-center">{{ video.likes }}</div>
                            </td>
                            <td class="border-b-[0.5px] border-gray-300 p-2 align-middle text-white">
                                <div class="flex h-full items-center justify-center">
                                    <button class="rounded-md bg-red-500 px-4 py-2 text-white hover:bg-red-600" @click="deleteVideo(video.id)">
                                        Delete
                                    </button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </NavLayout>
</template>
<!--
<style>
html {
    background-color: #282828 !important;
}
</style> -->
