declare module 'video.js' {
    import { Component } from 'vue';

    interface VideoJSOptions {
        controls?: boolean;
        autoplay?: boolean;
        preload?: 'auto' | 'metadata' | 'none';
        fluid?: boolean;
        playbackRates?: number[];
        controlBar?: {
            children?: string[];
        };
        html5?: {
            nativeVideoTracks?: boolean;
            nativeAudioTracks?: boolean;
            nativeTextTracks?: boolean;
        };
        userActions?: {
            hotkeys?: boolean;
            doubleClick?: boolean;
        };
    }

    interface VideoJSPlayer {
        play(): Promise<void>;
        pause(): void;
        paused(): boolean;
        currentTime(time?: number): number;
        duration(): number;
        volume(volume?: number): number;
        muted(muted?: boolean): boolean;
        isFullscreen(): boolean;
        requestFullscreen(): void;
        exitFullscreen(): void;
        dispose(): void;
        on(event: string, callback: () => void): void;
        seekable(enabled?: boolean): boolean;
        controlBar: {
            progressControl: {
                on(event: string, callback: (event: any) => void): void;
                getMouseTime(event: MouseEvent): number;
            };
        };
    }

    function videojs(element: HTMLVideoElement, options?: VideoJSOptions): VideoJSPlayer;

    export default videojs;
}
