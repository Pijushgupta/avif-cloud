<script setup>
import AppLayout from '../layouts/App.vue'
const props = defineProps({

    status:String,
    currency:String,
    amount:Number,
    tid:String
});
console.log(props);
</script>

<template>
    <AppLayout>
        <div class="max-w-[300px] mx-auto flex h-screen justify-center items-center ">
            <div  class="shadow p-4 pt-0 rounded-lg">
                <span v-if="status === 'succeeded'" class="flex justify-center items-center p-4 flex-col">

                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="stroke-green-400 w-16 h-16"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                            <span class="text-2xl">Payment Successful</span>
                    <span v-if="tid" class="flex flex-col justify-center items-center mt-2"><span>Transaction id</span><span>{{tid}}</span></span>
                        </span>
                <span v-if="status !== 'succeeded'" class="flex justify-center items-center p-4 flex-col">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="stroke-red-400 w-16 h-16"><path stroke-linecap="round" stroke-linejoin="round" d="M9.75 9.75l4.5 4.5m0-4.5l-4.5 4.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>

                            <span class="text-2xl">Payment Failed</span>
                            <span v-if="tid" class="flex flex-col justify-center items-center mt-2"><span>Transaction id</span><span>{{tid}}</span></span>

                        </span>
            </div>
        </div>

    </AppLayout>

</template>

