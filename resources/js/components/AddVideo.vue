<script setup lang="ts">

</script>

<template>
    <div>
        <button @click="showPopup = true">Add Video</button>
        <div v-if="showPopup" class="popup-overlay">
            <div class="popup-content">
                <h2>Add New Video</h2>
                <input v-model="videoTitle" placeholder="Video Title" />
                <input v-model="videoUrl" placeholder="Video URL" />
                <div class="popup-actions">
                    <button @click="submitVideo">Submit</button>
                    <button @click="showPopup = false">Cancel</button>
                </div>
            </div>
        </div>
    </div>

    <div class="flex "></div>


</template>

<style scoped>

</style>

<script lang="ts">
export default {
    name: 'VideoPlayer',
};
</script>
