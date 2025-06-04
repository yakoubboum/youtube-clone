declare module 'vue' {
    export interface GlobalComponents {
        VideoPlayer2: typeof import('../components/VideoPlayer2.vue')['default']
    }
}

declare module '*.vue' {
    import type { DefineComponent } from 'vue'
    const component: DefineComponent<{}, {}, any>
    export default component
}
