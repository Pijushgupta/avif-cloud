<script setup>
import Nav from "../components/Nav.vue";
import Sidebar from "../components/Sidebar.vue";

</script>

<template >
    <Nav class=""/>
    <div class="container-full mx-auto ">
        <div class="flex md:flex-row justify-between items-center ">
            <Sidebar/>
            <div class="w-[calc(100%-250px)] ml-[250px] h-screen">
                <slot/>
            </div>

        </div>
    </div>
</template>

<style scoped>

</style>
