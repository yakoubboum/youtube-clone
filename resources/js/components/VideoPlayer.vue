<script setup lang="ts">
import { onMounted, onUnmounted, ref } from 'vue';
import FullscreenIcon from 'vue-material-design-icons/Fullscreen.vue';
import FullscreenExitIcon from 'vue-material-design-icons/FullscreenExit.vue';
import PauseIcon from 'vue-material-design-icons/Pause.vue';
import PlayIcon from 'vue-material-design-icons/Play.vue';
import VolumeHighIcon from 'vue-material-design-icons/VolumeHigh.vue';
import VolumeOffIcon from 'vue-material-design-icons/VolumeOff.vue';

const props = defineProps({
    src: {
        type: String,
        required: true,
    },
});

const videoRef = ref<HTMLVideoElement | null>(null);
const isPlaying = ref(false);
const isMuted = ref(false);
const isFullscreen = ref(false);
const currentTime = ref(0);
const duration = ref(0);
const volume = ref(1);
const showControls = ref(true);
let controlsTimeout: number;

const togglePlay = () => {
    if (videoRef.value) {
        if (isPlaying.value) {
            videoRef.value.pause();
        } else {
            videoRef.value.play();
        }
        isPlaying.value = !isPlaying.value;
    }
};

const toggleMute = () => {
    if (videoRef.value) {
        videoRef.value.muted = !isMuted.value;
        isMuted.value = !isMuted.value;
    }
};

const toggleFullscreen = () => {
    if (!document.fullscreenElement) {
        videoRef.value?.requestFullscreen();
        // isFullscreen.value = true;
    } else {
        document.exitFullscreen();
        isFullscreen.value = false;
    }
};

const updateProgress = () => {
    if (videoRef.value) {
        currentTime.value = videoRef.value.currentTime;
        duration.value = videoRef.value.duration;
    }
};

const seek = (e: MouseEvent) => {
    if (videoRef.value) {
        const progressBar = e.currentTarget as HTMLElement;
        const rect = progressBar.getBoundingClientRect();
        const pos = (e.clientX - rect.left) / rect.width;
        videoRef.value.currentTime = pos * duration.value;
    }
};

const formatTime = (time: number) => {
    const minutes = Math.floor(time / 60);
    const seconds = Math.floor(time % 60);
    return `${minutes}:${seconds.toString().padStart(2, '0')}`;
};

const handleMouseMove = () => {
    showControls.value = true;
    clearTimeout(controlsTimeout);
    controlsTimeout = window.setTimeout(() => {
        if (isPlaying.value) {
            showControls.value = false;
        }
    }, 3000);
};

onMounted(() => {
    if (videoRef.value) {
        videoRef.value.addEventListener('timeupdate', updateProgress);
        videoRef.value.addEventListener('loadedmetadata', updateProgress);
    }
});

onUnmounted(() => {
    if (videoRef.value) {
        videoRef.value.removeEventListener('timeupdate', updateProgress);
        videoRef.value.removeEventListener('loadedmetadata', updateProgress);
    }
});
</script>

<template>
    <div class="relative aspect-video w-full overflow-hidden rounded-xl bg-black" @mousemove="handleMouseMove" @mouseleave="showControls = false">
        <video ref="videoRef" :src="src" class="h-full w-full object-contain" @click="togglePlay" />

        <!-- Custom Controls -->
        <div
            v-show="showControls"
            class="absolute right-0 bottom-0 left-0 bg-gradient-to-t from-black/80 to-transparent p-4 transition-opacity duration-300"
        >
            <!-- Progress Bar -->
            <div class="relative h-1 w-full cursor-pointer bg-gray-600" @click="seek">
                <div class="absolute h-full bg-red-600" :style="{ width: `${(currentTime / duration) * 100}%` }" />
            </div>

            <!-- Controls -->
            <div class="mt-2 flex items-center justify-between">
                <div class="flex items-center gap-4">
                    <button @click="togglePlay" class="text-white hover:text-gray-300">
                        <PlayIcon v-if="!isPlaying" :size="24" fillColor="#FFFFFF" />
                        <PauseIcon v-else :size="24" fillColor="#FFFFFF" />
                    </button>

                    <div class="flex items-center gap-2">
                        <button @click="toggleMute" class="text-white hover:text-gray-300">
                            <VolumeHighIcon v-if="!isMuted" :size="24" fillColor="#FFFFFF" />
                            <VolumeOffIcon v-else :size="24" fillColor="#FFFFFF" />
                        </button>
                        <input
                            type="range"
                            min="0"
                            max="1"
                            step="0.1"
                            v-model="volume"
                            class="w-20"
                            @input="(e) => videoRef && (videoRef.volume = parseFloat((e.target as HTMLInputElement).value))"
                        />
                    </div>

                    <div class="text-sm text-white">{{ formatTime(currentTime) }} / {{ formatTime(duration) }}</div>
                </div>

                <button @click="toggleFullscreen" class="text-white hover:text-gray-300">
                    <FullscreenIcon v-if="!isFullscreen" :size="24" fillColor="#FFFFFF" />
                    <FullscreenExitIcon v-else :size="24" fillColor="#FFFFFF" />
                </button>
            </div>
        </div>
    </div>
</template>

<style scoped>
input[type='range'] {
    -webkit-appearance: none;
    background: #4a4a4a;
    border-radius: 2px;
    height: 4px;
    outline: none;
}

input[type='range']::-webkit-slider-thumb {
    -webkit-appearance: none;
    background: #fff;
    border-radius: 50%;
    cursor: pointer;
    height: 12px;
    width: 12px;
}

input[type='range']::-moz-range-thumb {
    background: #fff;
    border: none;
    border-radius: 50%;
    cursor: pointer;
    height: 12px;
    width: 12px;
}
</style>

<script lang="ts">
export default {
    name: 'VideoPlayer',
};
</script>
