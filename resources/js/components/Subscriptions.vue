<script setup lang="ts">
import { ref } from 'vue';

const subscriptions = ref([
    {
        id: 1,
        name: 'John Doe',
        avatar: 'https://yt3.ggpht.com/yti/ANjgQV8kMldyvhcVkIIL4Uti9095Cw_gIQ4i5rf6T8cvk03vB58=s88-c-k-c0x00ffffff-no-rj',
    },
    {
        id: 2,
        name: 'Jane Doe',
        avatar: 'https://yt3.ggpht.com/yti/ANjgQV8kMldyvhcVkIIL4Uti9095Cw_gIQ4i5rf6T8cvk03vB58=s88-c-k-c0x00ffffff-no-rj',
    },
    {
        id: 3,
        name: 'John Doe',
        avatar: 'https://yt3.ggpht.com/yti/ANjgQV8kMldyvhcVkIIL4Uti9095Cw_gIQ4i5rf6T8cvk03vB58=s88-c-k-c0x00ffffff-no-rj',
    },
    {
        id: 4,
        name: 'John Doe',
        avatar: 'https://yt3.ggpht.com/yti/ANjgQV8kMldyvhcVkIIL4Uti9095Cw_gIQ4i5rf6T8cvk03vB58=s88-c-k-c0x00ffffff-no-rj',
    },
   
]);
</script>

<template>
    <li
        v-for="subscription in subscriptions"
        :key="subscription.id"
        class="flex cursor-pointer items-start rounded-lg p-2 text-center text-sm font-semibold text-white hover:bg-gray-700"
    >
        <div class="mr-2">
            <img :src="subscription.avatar" class="h-6 w-6 rounded-full" />
        </div>
        <div class="mt-1 ml-4">
            <span class="text-sm">{{ subscription.name }}</span>
        </div>
    </li>
</template>
