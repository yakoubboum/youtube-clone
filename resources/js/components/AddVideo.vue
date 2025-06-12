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
    thumbnail: null as File | null,
    visibility: 'public',
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

const handleThumbnailChange = (event: Event) => {
    const target = event.target as HTMLInputElement;
    form.thumbnail = target.files?.[0] || null;
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
        <div v-if="isPopupVisible" class="bg-opacity-50 fixed inset-0 z-70 flex items-center justify-center">
            <div class="w-full max-w-2xl rounded-lg bg-[#0f0f0f] p-6">
                <h2 class="mb-4 text-xl font-bold text-white">Upload Video</h2>

                <form @submit.prevent="submitVideo">
                    <div class="mb-4">
                        <label class="mb-2 block text-sm font-medium text-white">Title</label>
                        <input
                            v-model="form.title"
                            type="text"
                            class="w-full rounded-lg border border-gray-600 bg-[#1f1f1f] p-2 text-white"
                            required
                        />
                    </div>

                    <div class="mb-4">
                        <label class="mb-2 block text-sm font-medium text-white">Video File</label>
                        <input
                            type="file"
                            accept="video/mp4,video/mov,video/avi"
                            @change="handleFileChange"
                            class="w-full rounded-lg border border-gray-600 bg-[#1f1f1f] p-2 text-white"
                            required
                        />
                    </div>

                    <div class="mb-4">
                        <label class="mb-2 block text-sm font-medium text-white">Thumbnail (Optional)</label>
                        <input
                            type="file"
                            accept="image/jpeg,image/png,image/jpg"
                            @change="handleThumbnailChange"
                            class="w-full rounded-lg border border-gray-600 bg-[#1f1f1f] p-2 text-white"
                        />
                        <p class="mt-1 text-sm text-gray-400">If not provided, a thumbnail will be automatically generated from your video.</p>
                    </div>

                    <div class="mb-4">
                        <label class="mb-2 block text-sm font-medium text-white">Visibility</label>
                        <select v-model="form.visibility" class="w-full rounded-lg border border-gray-600 bg-[#1f1f1f] p-2 text-white">
                            <option value="public">Public</option>
                            <option value="private">Private</option>
                            <option value="unlisted">Unlisted</option>
                        </select>
                    </div>

                    <div v-if="error" class="mb-4 text-red-500">{{ error }}</div>

                    <div class="flex justify-end gap-4">
                        <button
                            type="button"
                            @click="emit('update:showPopup', false)"
                            class="rounded-lg bg-gray-600 px-4 py-2 text-white hover:bg-gray-700"
                        >
                            Cancel
                        </button>
                        <button
                            type="submit"
                            :disabled="isUploading"
                            class="rounded-lg bg-red-600 px-4 py-2 text-white hover:bg-red-700 disabled:opacity-50"
                        >
                            {{ isUploading ? 'Uploading...' : 'Upload' }}
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
