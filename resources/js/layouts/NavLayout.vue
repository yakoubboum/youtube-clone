<script setup lang="ts">
import MagnifyIcon from 'vue-material-design-icons/Magnify.vue';
import MenuIcon from 'vue-material-design-icons/Menu.vue';
</script>

<template>
    <div class="relative">
        <div id="TopNav" class="fixed z-20 flex h-[60px] w-[100%] items-center justify-between bg-[#0f0f0f]">
            <div class="flex items-center">
                <button class="ml-3 inline-block rounded-full p-2 hover:bg-gray-800"><MenuIcon :size="26" fillColor="#FFFFFF" /></button>

                <div class="mx-2"></div>

                <div class="mr-10 flex cursor-pointer items-center justify-center text-white">YouTube</div>
            </div>

            <div class="hidden w-[600px] md:block">
                <div class="flex items-center rounded-full bg-[#121212]">
                    <input
                        type="text"
                        class="form-control m-0 block w-full rounded-l-full border border-[#303030] bg-[#121212] bg-clip-padding px-5 py-1.5 text-base font-normal text-gray-200 placeholder-gray-400 transition ease-in-out focus:border-[#1a73e8] focus:outline-none"
                        placeholder="Search"
                    />
                    <div
                        class="flex h-9.5 w-16 cursor-pointer items-center justify-center rounded-r-full border border-l-0 border-[#303030] bg-[#222222] hover:bg-[#303030]"
                    >
                        <MagnifyIcon class="mx-4" fillColor="#FFFFFF" :size="20" />
                    </div>
                </div>
            </div>

            <div>
                <img
                    class="rounded-full mx-8"
                    width="35"
                    src="https://yt3.ggpht.com/yti/ANjgQV8kMldyvhcVkIIL4Uti9095Cw_gIQ4i5rf6T8cvk03vB58=s88-c-k-c0x00ffffff-no-rj"
                >
            </div>


        </div>
        <div id="SideNav"></div>
        <div id="SideNavOverlay"></div>
    </div>
</template>
