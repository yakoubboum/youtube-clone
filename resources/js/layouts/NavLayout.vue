<script setup lang="ts">
import SideNavLayout from '@/layouts/SideNavLayout.vue';
import TopNavLayout from '@/layouts/TopNavLayout.vue';
import { usePage } from '@inertiajs/vue3';
import { computed, ref } from 'vue';

// const sideNavItems = [
//     { iconString: 'Home', url: '/' },
//     { iconString: 'Subscriptions', url: '/subscriptions' },
//     { type: 'separator' },
//     { type: 'heading', text: 'You' },
//     { iconString: 'History', url: '/history' },
//     { iconString: 'Your Videos', url: '/videos' },
//     { iconString: 'Watch Later', url: '/watch-later' },
//     { iconString: 'Liked Videos', url: '/liked-videos' },
//     { iconString: 'Downloads', url: '/downloads' },
//     { iconString: 'Clips', url: '/clips' },
//     { type: 'separator' },
//     { iconString: 'Add Video', url: '/video/create' },
//     { iconString: 'Delete Video', url: '/delete-video' },
// ];

const openSideNav = ref(false);
const page = usePage();

const navBackgroundColor = computed(() => {
    switch (page.url) {
        case '/video/create':
            return 'bg-[#282828]'; // Darker background for create page
        case '/':
            return 'bg-[#0f0f0f]'; // Default background for home
        default:
            return 'bg-[#0f0f0f]'; // Default background for other pages
    }
});
</script>

<script lang="ts">
export default {
    name: 'NavLayout',
};
</script>

<template>
    <div class="relative">
        <TopNavLayout :navBackgroundColor="navBackgroundColor" @openSideNav="openSideNav = !openSideNav" />

        <SideNavLayout :openSideNav="openSideNav" :navBackgroundColor="navBackgroundColor" />

        <div class="absolute top-[55px] right-0 bottom-0 left-0 h-full" :class="navBackgroundColor">
            <slot />
        </div>
    </div>
</template>
