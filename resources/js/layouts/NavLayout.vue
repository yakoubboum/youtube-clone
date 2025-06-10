<script setup lang="ts">
import SideNavItem from '@/components/SideNavItem.vue';
import { usePage } from '@inertiajs/vue3';
import { computed, ref } from 'vue';
import MagnifyIcon from 'vue-material-design-icons/Magnify.vue';
import MenuIcon from 'vue-material-design-icons/Menu.vue';

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
        <div id="TopNav" class="fixed z-20 flex h-[60px] w-[100%] items-center justify-between" :class="navBackgroundColor">
            <div class="flex items-center">
                <button @click="openSideNav = !openSideNav" class="ml-3 inline-block rounded-full p-2 hover:bg-gray-800">
                    <MenuIcon :size="26" fillColor="#FFFFFF" />
                </button>

                <div class="mx-2"></div>

                <div class="mr-10 flex cursor-pointer items-center justify-center text-white">YouTube</div>
            </div>

            <div class="hidden w-[600px] md:block">
                <div class="flex items-center rounded-full bg-[#121212]">
                    <input
                        type="text"
                        class="form-control m-0 block w-full rounded-l-full border border-[#303030] bg-[#121212] bg-clip-padding px-5 py-1.5 text-base font-normal text-gray-200 placeholder-gray-400 transition ease-in-out focus:border-[#1a73e8] focus:outline-none"
                        placeholder="Search"
                    />
                    <div
                        class="flex h-9.5 w-16 cursor-pointer items-center justify-center rounded-r-full border border-l-0 border-[#303030] bg-[#222222] hover:bg-[#303030]"
                    >
                        <MagnifyIcon class="mx-4" fillColor="#FFFFFF" :size="20" />
                    </div>
                </div>
            </div>

            <div>
                <img
                    class="mx-8 cursor-pointer rounded-full"
                    width="35"
                    src="https://yt3.ggpht.com/yti/ANjgQV8kMldyvhcVkIIL4Uti9095Cw_gIQ4i5rf6T8cvk03vB58=s88-c-k-c0x00ffffff-no-rj"
                />
            </div>
        </div>
        <div
            id="SideNav"
            class="fixed z-10 h-full text-white shadow-lg transition-all duration-300 ease-in-out"
            :class="[openSideNav ? 'w-[250px] translate-x-0' : '-translate-x-full', navBackgroundColor]"
        >
            <ul class="mt-[60px] w-full px-3" :class="[!openSideNav ? 'p-2' : 'px-5 pt-[7px] pb-2']">
                <SideNavItem :openSideNav="openSideNav" iconString="Home" />
                <SideNavItem :openSideNav="openSideNav" iconString="Add Video" />
                <SideNavItem :openSideNav="openSideNav" iconString="History" />
                <hr class="my-2 h-[1px] w-full bg-gray-700" />
                <SideNavItem :openSideNav="openSideNav" iconString="Liked" />
                <SideNavItem :openSideNav="openSideNav" iconString="Subscriptions" />
                <SideNavItem :openSideNav="openSideNav" iconString="Library" />
                <SideNavItem :openSideNav="openSideNav" iconString="Watch Later" />
                <SideNavItem :openSideNav="openSideNav" iconString="Delete Video" />

                <div v-if="openSideNav">
                    <div class="my-2.5 border-b border-b-gray-700"></div>
                    <div class="text-extrabold text-[14px] text-gray-400">
                        About Press Copyright
                        <div>Contact us</div>
                        Creator Advertise Developers
                    </div>
                    <div class="my-2.5 border-b border-b-gray-700"></div>
                    <div class="text-extrabold text-[14px] text-gray-400">
                        Terms Privacy Policy & Safety
                        <div>How YouTube works</div>
                        <span>Test new features</span>
                    </div>
                </div>
            </ul>
        </div>


        <div class="absolute top-[60px] left-0 right-0 bottom-0 w-full" style="min-height:calc(100vh - 60px);">
            <slot />
        </div>
    </div>
</template>
