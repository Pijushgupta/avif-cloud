<script setup>
import AppLayout from '../layouts/App.vue'
const props = defineProps({
    exception:String
})

</script>

<template>
    <AppLayout>
        <div class="max-w-[300px] mx-auto flex h-screen justify-center items-center ">
            <div class="shadow p-4  rounded-lg flex flex-col ">
                <span class="font-bold">Exception</span>
                <span class="break-all">{{exception}}</span>
            </div>
        </div>
    </AppLayout>

</template>

<style scoped>

</style>
