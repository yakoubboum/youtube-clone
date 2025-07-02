<script setup lang="ts">
import SideNavItem from '@/components/SideNavItem.vue';
import Subscriptions from '@/components/Subscriptions.vue';
import { toRefs } from 'vue';

const props = defineProps({
    openSideNav: Boolean,
    navBackgroundColor: String,
});

const { openSideNav, navBackgroundColor } = toRefs(props);
</script>

<template>
    <div
        id="SideNav"
        class="fixed top-[60px] z-20 h-[calc(100vh-60px)] overflow-y-auto scrollbar-thumb-rounded scrollbar-thin scrollbar-thumb-gray-700 scrollbar-track-gray-900 text-white shadow-lg transition-all duration-300 ease-in-out"
        :class="[openSideNav ? 'w-[250px] translate-x-0' : '-translate-x-full', navBackgroundColor]"
    >
        <ul class="mt-[10px] w-full px-3" :class="[!openSideNav ? 'p-2' : 'px-5 pt-[7px] pb-2']">
            <SideNavItem :openSideNav="openSideNav" iconString="Home" />
            <SideNavItem :openSideNav="openSideNav" iconString="Subscriptions" />

            <hr class="my-2 h-px w-full border-0 bg-gray-700" />
            <SideNavItem :openSideNav="openSideNav" iconString="History" />
            <SideNavItem :openSideNav="openSideNav" iconString="Liked Videos" />
            <SideNavItem :openSideNav="openSideNav" iconString="Library" />
            <SideNavItem :openSideNav="openSideNav" iconString="Add Video" />
            <SideNavItem :openSideNav="openSideNav" iconString="Watch Later" />
            <hr class="my-2 h-px w-full border-0 bg-gray-700" />
            <Subscriptions />
            <hr class="my-2 h-px w-full border-0 bg-gray-700" />

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
                <div class="text-extrabold text-[14px] text-gray-400">
                    Terms Privacy Policy & Safety
                    <div>How YouTube works</div>
                    <span>Test new features</span>
                </div>
            </div>
        </ul>
    </div>
</template>
