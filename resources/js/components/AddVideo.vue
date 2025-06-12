<script setup lang="ts">
import { useForm } from '@inertiajs/vue3';
import { computed, ref } from 'vue';

const props = defineProps<{
    showPopup: boolean;
}>();

const emit = defineEmits(['update:showPopup']);

const form = useForm({
    title: '',
    video: null as File | null,
});

const isUploading = ref(false);
const error = ref<string | null>(null);

// Use props in a computed property to avoid unused warning
const isPopupVisible = computed(() => props.showPopup);

const submitVideo = () => {
    if (!form.video || !form.title) return;

    isUploading.value = true;
    error.value = null;

    form.post(route('videos.store'), {
        preserveScroll: true,
        onSuccess: () => {
            form.reset();
            emit('update:showPopup', false);
        },
        onError: (errors) => {
            error.value = Object.values(errors).flat().join(', ');
        },
        onFinish: () => {
            isUploading.value = false;
        },
    });
};

const handleFileChange = (event: Event) => {
    const target = event.target as HTMLInputElement;
    form.video = target.files?.[0] || null;
};
</script>

<template>
    <div>
        <!-- Main content of the AddVideo component -->
        <div class="w-full bg-[#282828] p-3">
            <h1 class="text-2xl font-bold text-white">Your videos</h1>
            <div>
                <button
                    @click="emit('update:showPopup', true)"
                    class="mt-2 cursor-pointer rounded-md bg-white px-4 py-2 text-black hover:bg-gray-200"
                >
                    Add Video
                </button>
            </div>
        </div>

        <!-- Popup -->
        <div v-if="isPopupVisible" class="fixed inset-0 z-[60] flex items-center justify-center">
            <div class="popup-content rounded-lg bg-[#282828] p-4 text-white shadow-lg">
                <h2 class="mb-4 text-xl font-bold">Add New Video</h2>
                <form @submit.prevent="submitVideo">
                    <input v-model="form.title" placeholder="Video Title" required class="mr-2 mb-2 w-full rounded-md border-1 border-gray-300 p-2" />
                    <input
                        @change="handleFileChange"
                        type="file"
                        accept="video/*"
                        required
                        class="mb-4 w-full rounded-md border-1 border-gray-300 p-2"
                    />
                    <div v-if="error" class="mb-4 text-red-500">{{ error }}</div>
                    <div class="popup-actions flex justify-end">
                        <button
                            type="submit"
                            :disabled="isUploading || form.processing"
                            class="mr-2 rounded-md bg-white px-4 py-2 text-black hover:bg-gray-200 disabled:opacity-50"
                        >
                            {{ isUploading || form.processing ? 'Uploading...' : 'Submit' }}
                        </button>
                        <button
                            type="button"
                            @click="emit('update:showPopup', false)"
                            :disabled="isUploading || form.processing"
                            class="rounded-md bg-white px-4 py-2 text-black hover:bg-gray-200 disabled:opacity-50"
                        >
                            Cancel
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<style scoped>
.popup-content {
    max-width: 400px;
    width: 100%;
}
</style>

<script lang="ts">
export default {
    name: 'VideoPlayer',
};
</script>
