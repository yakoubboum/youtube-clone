<script setup lang="ts">
import AddVideo from '@/components/AddVideo.vue';
import NavLayout from '@/layouts/NavLayout.vue';
import { Head } from '@inertiajs/vue3';
import { ref } from 'vue';

const showPopup = ref(false);
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
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="h-[200px] w-[300px] border-b-[0.5px] border-gray-300 p-2 align-middle text-white">
                                <div class="flex h-full flex-col items-center justify-center">
                                    <img src="/storage/thumbnails/Car.png" alt="" class="mb-2 object-cover" />
                                    <p class="text-white">Car</p>
                                </div>
                            </td>
                            <td class="border-b-[0.5px] border-gray-300 p-2 align-middle text-white">
                                <div class="flex h-full items-center justify-center">public</div>
                            </td>
                            <td class="border-b-[0.5px] border-gray-300 p-2 align-middle text-white">
                                <div class="flex h-full items-center justify-center">2025-01-01</div>
                            </td>
                            <td class="border-b-[0.5px] border-gray-300 p-2 align-middle text-white">
                                <div class="flex h-full items-center justify-center">100</div>
                            </td>
                            <td class="border-b-[0.5px] border-gray-300 p-2 align-middle text-white">
                                <div class="flex h-full items-center justify-center">100</div>
                            </td>
                        </tr>
                        <tr>
                            <td class="h-[200px] w-[300px] border-b-[0.5px] border-gray-300 p-2 align-middle text-white">
                                <div class="flex h-full flex-col items-center justify-center">
                                    <img src="/storage/thumbnails/Car.png" alt="" class="mb-2 object-cover" />
                                    <p class="text-white">Car</p>
                                </div>
                            </td>
                            <td class="border-b-[0.5px] border-gray-300 p-2 align-middle text-white">
                                <div class="flex h-full items-center justify-center">public</div>
                            </td>
                            <td class="border-b-[0.5px] border-gray-300 p-2 align-middle text-white">
                                <div class="flex h-full items-center justify-center">2025-01-01</div>
                            </td>
                            <td class="border-b-[0.5px] border-gray-300 p-2 align-middle text-white">
                                <div class="flex h-full items-center justify-center">100</div>
                            </td>
                            <td class="border-b-[0.5px] border-gray-300 p-2 align-middle text-white">
                                <div class="flex h-full items-center justify-center">100</div>
                            </td>
                        </tr>
                        <tr>
                            <td class="h-[200px] w-[300px] border-b-[0.5px] border-gray-300 p-2 align-middle text-white">
                                <div class="flex h-full flex-col items-center justify-center">
                                    <img src="/storage/thumbnails/Car.png" alt="" class="mb-2 object-cover" />
                                    <p class="text-white">Car</p>
                                </div>
                            </td>
                            <td class="border-b-[0.5px] border-gray-300 p-2 align-middle text-white">
                                <div class="flex h-full items-center justify-center">public</div>
                            </td>
                            <td class="border-b-[0.5px] border-gray-300 p-2 align-middle text-white">
                                <div class="flex h-full items-center justify-center">2025-01-01</div>
                            </td>
                            <td class="border-b-[0.5px] border-gray-300 p-2 align-middle text-white">
                                <div class="flex h-full items-center justify-center">100</div>
                            </td>
                            <td class="border-b-[0.5px] border-gray-300 p-2 align-middle text-white">
                                <div class="flex h-full items-center justify-center">100</div>
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
