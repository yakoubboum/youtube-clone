<script setup lang="ts">
import NavLayout from '@/layouts/NavLayout.vue';
import { Head } from '@inertiajs/vue3';
</script>

<template>
    <Head title="Add Video"></Head>

    <NavLayout>
        <div class="w-full bg-[#282828] p-3">
            <h1 class="text-2xl font-bold text-white">Your videos</h1>
            <div>
                <button class="mt-2 rounded-md bg-white px-4 py-2 text-black hover:bg-gray-200 cursor-pointer">Add Video</button>
            </div>

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
                            <td class="h-[200px] w-[300px] border-b-[0.5px] border-gray-300 p-2 text-white align-middle">
                                <div class="flex flex-col items-center justify-center h-full">
                                    <img src="/storage/thumbnails/Car.png" alt="" class="object-cover mb-2" />
                                    <p class="text-white">Car</p>
                                </div>
                            </td>
                            <td class="border-b-[0.5px] border-gray-300 p-2 text-white align-middle">
                                <div class="flex items-center justify-center h-full">public</div>
                            </td>
                            <td class="border-b-[0.5px] border-gray-300 p-2 text-white align-middle">
                                <div class="flex items-center justify-center h-full">2025-01-01</div>
                            </td>
                            <td class="border-b-[0.5px] border-gray-300 p-2 text-white align-middle">
                                <div class="flex items-center justify-center h-full">100</div>
                            </td>
                            <td class="border-b-[0.5px] border-gray-300 p-2 text-white align-middle">
                                <div class="flex items-center justify-center h-full">100</div>
                            </td>
                        </tr>
                        <tr>
                            <td class="h-[200px] w-[300px] border-b-[0.5px] border-gray-300 p-2 text-white align-middle">
                                <div class="flex flex-col items-center justify-center h-full">
                                    <img src="/storage/thumbnails/Car.png" alt="" class="object-cover mb-2" />
                                    <p class="text-white">Car</p>
                                </div>
                            </td>
                            <td class="border-b-[0.5px] border-gray-300 p-2 text-white align-middle">
                                <div class="flex items-center justify-center h-full">public</div>
                            </td>
                            <td class="border-b-[0.5px] border-gray-300 p-2 text-white align-middle">
                                <div class="flex items-center justify-center h-full">2025-01-01</div>
                            </td>
                            <td class="border-b-[0.5px] border-gray-300 p-2 text-white align-middle">
                                <div class="flex items-center justify-center h-full">100</div>
                            </td>
                            <td class="border-b-[0.5px] border-gray-300 p-2 text-white align-middle">
                                <div class="flex items-center justify-center h-full">100</div>
                            </td>
                        </tr>
                        <tr>
                            <td class="h-[200px] w-[300px] border-b-[0.5px] border-gray-300 p-2 text-white align-middle">
                                <div class="flex flex-col items-center justify-center h-full">
                                    <img src="/storage/thumbnails/Car.png" alt="" class="object-cover mb-2" />
                                    <p class="text-white">Car</p>
                                </div>
                            </td>
                            <td class="border-b-[0.5px] border-gray-300 p-2 text-white align-middle">
                                <div class="flex items-center justify-center h-full">public</div>
                            </td>
                            <td class="border-b-[0.5px] border-gray-300 p-2 text-white align-middle">
                                <div class="flex items-center justify-center h-full">2025-01-01</div>
                            </td>
                            <td class="border-b-[0.5px] border-gray-300 p-2 text-white align-middle">
                                <div class="flex items-center justify-center h-full">100</div>
                            </td>
                            <td class="border-b-[0.5px] border-gray-300 p-2 text-white align-middle">
                                <div class="flex items-center justify-center h-full">100</div>
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
