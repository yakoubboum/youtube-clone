<template>
    <div class="relative">
        <div
            class="m-2 rounded-lg bg-[#0f0f0f] cursor-pointer "
            :class="[
                show && width > 639
                    ? 'absolute z-30 transition delay-150 duration-300 ease-in-out hover:translate-y-8 hover:scale-125 hover:bg-[#202020]'
                    : '',
            ]"
            @click="navigateToVideo"
        >
            <div
                @mouseover="show = true"
                @mouseleave="
                    show = false;
                    showVideo = false;
                "
            >
                <img
                    class="aspect-video cursor-pointer"
                    :src="getThumbnailUrl()"
                    :class="[show ? 'rounded-t-lg transition delay-150 ease-in-out' : 'rounded-lg', showVideo ? 'hidden delay-350' : '']"
                />
                <div class="aspect-video h-full w-full cursor-pointer" :class="showVideo ? '' : 'hidden delay-350'">
                    <video ref="video" :src="getVideoUrl()" type="video/mp4" class="h-full w-full object-cover" muted loop />
                </div>
            </div>

            <div>
                <div class="mt-1.5 flex">
                    <div>
                        <img class="m-1.5 mt-2 flex h-8 w-8 items-baseline rounded-full" :src="image || ''" />
                    </div>
                    <div class="mt-1 px-1.5 text-white">
                        <div class="w-full cursor-pointer text-[17px] font-extrabold">{{ title.substring(0, 100) }}</div>
                        <p class="flex cursor-pointer items-center gap-1 text-[14px] font-extrabold text-gray-300">
                            {{ user.substring(0, 30) }}
                            <CheckCircle fillColor="#888888" :size="17" />
                        </p>
                        <div class="mb-1 cursor-pointer text-sm text-gray-300">{{ views }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup lang="ts">
import { router } from '@inertiajs/vue3';
import { defineProps, onMounted, ref, toRefs, watch } from 'vue';
import CheckCircle from 'vue-material-design-icons/CheckCircle.vue';

const props = defineProps({
    id: {
        type: Number,
        required: true,
    },
    title: {
        type: String,
        required: true,
    },
    user: {
        type: String,
        required: true,
    },
    views: {
        type: Number,
        required: true,
    },
    image: {
        type: String,
        required: true,
    },
    videoUrl: {
        type: String,
        required: true,
    },
    thumbnail: {
        type: String,
        required: true,
    },
    visibility: {
        type: String,
        default: 'public',
    },
});

const { title, user, views, image, videoUrl, thumbnail, visibility } = toRefs(props);

const show = ref(false);
const showVideo = ref(false);
const video = ref<HTMLVideoElement | null>(null);
const width = ref(document.documentElement.clientWidth);

const getThumbnailUrl = () => {
    if (!thumbnail?.value) {
        return '/storage/thumbnails/default.jpg';
    }
    return `/storage/${thumbnail.value}`;
};

const getVideoUrl = () => {
    if (visibility.value === 'public') {
        return `/storage/${videoUrl?.value || ''}`;
    }
    return `/video-stream/${videoUrl?.value?.split('/').pop() || ''}`;
};

const navigateToVideo = () => {
    router.visit(`/video/${props.id}`);
};

onMounted(() => {
    window.addEventListener('resize', () => {
        width.value = document.documentElement.clientWidth;
    });
});

watch(
    () => show.value,
    (show) => {
        if (show && video.value) {
            showVideo.value = true;
            video.value.play();
            return '';
        }

        if (video.value) {
            showVideo.value = false;
            video.value.pause();
            video.value.currentTime = 0;
        }
    },
);
</script>

<script lang="ts">
export default {
    name: 'VideoCard',
};
</script>

<style lang="scss" scoped></style>
