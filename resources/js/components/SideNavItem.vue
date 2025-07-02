<template>
    <li class="flex cursor-pointer items-start rounded-lg p-2 text-center text-sm font-semibold text-white hover:bg-gray-700">
        <div class="mr-2">
            <span v-if="iconString === 'Home'" aria-hidden="true" role="img">
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    fill="currentColor"
                    height="24"
                    viewBox="0 0 24 24"
                    width="24"
                    focusable="false"
                    aria-hidden="true"
                    style="pointer-events: none; display: inherit; width: 100%; height: 100%"
                >
                    <path
                        clip-rule="evenodd"
                        d="M22.146 11.146a.5.5 0 01-.353.854H20v7.5a1.5 1.5 0 01-1.5 1.5H14v-8h-4v8H5.5A1.5 1.5 0 014 19.5V12H2.207a.5.5 0 01-.353-.854L12 1l10.146 10.146Z"
                        fill-rule="evenodd"
                    ></path>
                </svg>
            </span>
            <component v-else :is="icon" class="h-6 w-6" />
        </div>
        <div class="mt-1 ml-4">
            <span class="text-sm">{{ iconString }}</span>
        </div>
    </li>
</template>

<script setup lang="ts">
import { defineProps, toRefs } from 'vue';
import ClockOutline from 'vue-material-design-icons/ClockOutline.vue';
import ContentCut from 'vue-material-design-icons/ContentCut.vue';
import Download from 'vue-material-design-icons/Download.vue';
import History from 'vue-material-design-icons/History.vue';
import Home from 'vue-material-design-icons/Home.vue';
import PlaylistPlay from 'vue-material-design-icons/PlaylistPlay.vue';
import ThumbUpOutline from 'vue-material-design-icons/ThumbUpOutline.vue';
import VideoPlusOutlineIcon from 'vue-material-design-icons/VideoPlusOutline.vue';
import YoutubeSubscription from 'vue-material-design-icons/YoutubeSubscription.vue';

const props = defineProps({
    iconString: String,
});

const { iconString } = toRefs(props);

let icon = null;

if (iconString?.value === 'Home') icon = Home;
if (iconString?.value === 'Subscriptions') icon = YoutubeSubscription;
if (iconString?.value === 'History') icon = History;
if (iconString?.value === 'Library') icon = PlaylistPlay;
if (iconString?.value === 'Liked Videos') icon = ThumbUpOutline;
if (iconString?.value === 'Watch Later') icon = ClockOutline;
if (iconString?.value === 'Downloads') icon = Download;
if (iconString?.value === 'Clips') icon = ContentCut;
if (iconString?.value === 'Add Video') icon = VideoPlusOutlineIcon;
</script>
