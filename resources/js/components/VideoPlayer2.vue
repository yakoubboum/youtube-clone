<script setup lang="ts">
import videojs from 'video.js';
import 'video.js/dist/video-js.css';
import { onMounted, onUnmounted, ref } from 'vue';

const props = defineProps({
    video: {
        type: Object,
        required: true,
    },
});

const videoRef = ref<HTMLVideoElement | null>(null);
let player: any = null;
let keyboardHandler: ((e: KeyboardEvent) => void) | null = null;

const getVideoSource = () => {
    return `/video-stream/${props.video.file_path.split('/').pop()}`;
};

const getThumbnailUrl = () => {
    if (!props.video.thumbnail_path) {
        return null;
    }
    if (props.video.visibility === 'public') {
        return `/storage/${props.video.thumbnail_path}`;
    }
    return `/storage/${props.video.thumbnail_path}`;
};

const trackVideoAnalytics = () => {
    if (!player) return;

    player.on('play', () => {
        console.log('Video started playing');
    });

    player.on('pause', () => {
        console.log('Video paused');
    });

    player.on('ended', () => {
        console.log('Video ended');
    });

    player.on('timeupdate', () => {
        console.log('Current time:', player.currentTime());
    });
};

onMounted(() => {
    if (videoRef.value) {
        player = videojs(videoRef.value, {
            controls: true,
            autoplay: true,
            preload: 'auto',
            fluid: true,
            playbackRates: [0.5, 1, 1.5, 2],
            controlBar: {
                children: [
                    'playToggle',
                    'volumePanel',
                    'progressControl',
                    'currentTimeDisplay',
                    'timeDivider',
                    'durationDisplay',
                    'playbackRateMenuButton',
                    'fullscreenToggle',
                ],
            },
            html5: {
                nativeVideoTracks: true,
                nativeAudioTracks: true,
                nativeTextTracks: true,
                hls: {
                    overrideNative: true,
                },
            },
            userActions: {
                hotkeys: true,
                doubleClick: true,
            },
        });

        // Enable seeking
        player.seekable(true);

        // Log duration on loadedmetadata
        player.on('loadedmetadata', () => {
            console.log('Video duration:', player.duration());
        });

        // Handle seeking events
        player.on('seeking', () => {
            const currentTime = player.currentTime();
            console.log('Seeking to:', currentTime);
        });

        // Handle seeked events (when seeking is complete)
        player.on('seeked', () => {
            const currentTime = player.currentTime();
            console.log('Seeked to:', currentTime);
        });

        // Attach keyboard event listener
        keyboardHandler = (e: KeyboardEvent) => {
            if (!player) return;
            console.log('Key pressed:', e.key, 'Current time:', player.currentTime());
            switch (e.key) {
                case ' ':
                    e.preventDefault();
                    if (player.paused()) {
                        player.play();
                    } else {
                        player.pause();
                    }
                    break;
                case 'ArrowRight':
                    e.preventDefault();
                    const currentTime = player.currentTime();
                    const duration = player.duration();
                    const forwardTime = Math.min(currentTime + 10, duration);
                    console.log('Skipping forward from', currentTime, 'to', forwardTime);
                    player.currentTime(forwardTime);
                    break;
                case 'ArrowLeft':
                    e.preventDefault();
                    const currentTime2 = player.currentTime();
                    const backwardTime = Math.max(currentTime2 - 10, 0);
                    console.log('Skipping backward from', currentTime2, 'to', backwardTime);
                    player.currentTime(backwardTime);
                    break;
                case 'f':
                    if (player.isFullscreen()) {
                        player.exitFullscreen();
                    } else {
                        player.requestFullscreen();
                    }
                    break;
                case 'm':
                    player.muted(!player.muted());
                    break;
            }
        };
        document.addEventListener('keydown', keyboardHandler);

        trackVideoAnalytics();
    }
});

onUnmounted(() => {
    if (player) {
        player.dispose();
    }
    if (keyboardHandler) {
        document.removeEventListener('keydown', keyboardHandler);
    }
});
</script>

<template>
    <div class="video-container">
        <video ref="videoRef" class="video-js vjs-default-skin vjs-big-play-centered" :poster="getThumbnailUrl()">
            <source :src="getVideoSource()" type="video/mp4" />
            <p class="vjs-no-js">To view this video please enable JavaScript, and consider upgrading to a web browser that supports HTML5 video</p>
        </video>
    </div>
</template>

<style scoped>
.video-container {
    position: relative;
    width: 100%;
    aspect-ratio: 16/9;
    background: #000;
    border-radius: 12px;
    overflow: hidden;
}

.video-js {
    width: 100%;
    height: 100%;
}

/* Control Bar Styling */
:deep(.video-js .vjs-control-bar) {
    background-color: transparent;
    height: 40px;
    display: flex;
    align-items: center;
}

/* Progress Bar Styling */
:deep(.video-js .vjs-progress-control) {
    position: static;
    width: 100%;
    height: 4px;
    transition: height 0.1s ease;
    opacity: 1 !important;
    z-index: 10;
    margin: 0;
    padding: 0;
    display: flex;
    align-items: center;
}

:deep(.video-js .vjs-progress-holder) {
    height: 4px;
    cursor: pointer;
    transition: height 0.1s ease;
    margin: 0;
    background-color: rgba(255, 255, 255, 0.2);
    border-radius: 2px;
}

:deep(.video-js .vjs-progress-control:hover .vjs-progress-holder) {
    height: 8px;
}

:deep(.video-js .vjs-progress-control .vjs-progress-holder .vjs-play-progress) {
    background-color: #ff0000;
    transition: width 0.1s linear;
    border-radius: 2px;
}

:deep(.video-js .vjs-progress-control .vjs-progress-holder .vjs-load-progress) {
    background: rgba(255, 255, 255, 0.3);
    border-radius: 2px;
}

:deep(.video-js .vjs-progress-control .vjs-progress-holder .vjs-load-progress div) {
    background: rgba(255, 255, 255, 0.3);
    border-radius: 2px;
}

:deep(.video-js .vjs-progress-control .vjs-progress-holder .vjs-play-progress:before) {
    content: '';
    position: absolute;
    top: -6px;
    right: -8px;
    width: 16px;
    height: 16px;
    background: #ff0000;
    border-radius: 50%;
    transition: transform 0.1s ease;
    transform: scale(0);
    box-shadow: 0 0 0 2px rgba(255, 255, 255, 0.5);
}

:deep(.video-js .vjs-progress-control:hover .vjs-progress-holder .vjs-play-progress:before) {
    transform: scale(1);
}

:deep(.video-js .vjs-progress-control .vjs-mouse-display) {
    background-color: #fff;
    z-index: 1;
    width: 6px;
    height: 100%;
    transition: opacity 0.1s ease;
    border-radius: 3px;
    box-shadow: 0 0 0 2px rgba(0, 0, 0, 0.5);
}

:deep(.video-js .vjs-progress-control .vjs-progress-holder .vjs-slider) {
    background-color: rgba(255, 255, 255, 0.3);
    transition: height 0.1s ease;
    height: 4px;
}

:deep(.video-js .vjs-progress-control:hover .vjs-progress-holder .vjs-slider) {
    height: 8px;
}

/* Progress Bar Hover Effects */
:deep(.video-js .vjs-progress-control:hover .vjs-progress-holder) {
    height: 8px;
}

:deep(.video-js .vjs-progress-control:hover .vjs-progress-holder .vjs-play-progress:before) {
    transform: scale(1);
}

:deep(.video-js .vjs-progress-control:hover .vjs-mouse-display) {
    opacity: 1;
}

/* Progress Bar Active State */
:deep(.video-js .vjs-progress-control.vjs-dragging .vjs-progress-holder) {
    height: 8px;
}

:deep(.video-js .vjs-progress-control.vjs-dragging .vjs-play-progress:before) {
    transform: scale(1.1);
}

/* Play Button Styling */
:deep(.video-js .vjs-big-play-button) {
    background-color: rgba(0, 0, 0, 0.6);
    border: none;
    border-radius: 50%;
    width: 70px;
    height: 70px;
    line-height: 70px;
    transition: transform 0.2s ease;
}

:deep(.video-js .vjs-big-play-button:hover) {
    background-color: rgba(0, 0, 0, 0.8);
    transform: scale(1.1);
}

:deep(.video-js .vjs-big-play-button .vjs-icon-placeholder) {
    font-size: 40px;
}

/* Control Elements Styling */
:deep(.video-js .vjs-control) {
    width: 3em;
    height: 3em;
    display: flex;
    align-items: center;
    justify-content: center;
}

:deep(.video-js .vjs-time-control) {
    padding: 0 5px;
    font-size: 1em;
    line-height: 3em;
}

:deep(.video-js .vjs-volume-panel) {
    width: 8em;
    display: flex;
    align-items: center;
}

:deep(.video-js .vjs-playback-rate) {
    width: 5em;
    display: flex;
    align-items: center;
}

:deep(.video-js .vjs-fullscreen-control) {
    width: 3em;
    display: flex;
    align-items: center;
    justify-content: center;
}

/* Hover States */
:deep(.video-js .vjs-control:hover) {
    text-shadow: 0 0 1em #fff;
}

/* Volume Control */
:deep(.video-js .vjs-volume-level) {
    background-color: #ff0000;
}

:deep(.video-js .vjs-volume-bar) {
    background-color: rgba(255, 255, 255, 0.3);
}

/* Time Display */
:deep(.video-js .vjs-time-divider) {
    display: flex;
    align-items: center;
}

:deep(.video-js .vjs-current-time),
:deep(.video-js .vjs-duration) {
    display: flex;
    align-items: center;
}
</style>

<script lang="ts">
export default {
    name: 'VideoPlayer2',
};
</script>
