<script setup>
import AppLayout from '../layouts/App.vue'

import 'https://js.stripe.com/v3/';
import {onMounted} from 'vue'

const props = defineProps({
    clientSecret: String,
    apiStripe:String,
    amount:String | Number,
    currency:String,
})
const currencySymbol = props.currency === 'inr' ? '₹' : '$';

const stripe = Stripe(props.apiStripe);
const options = {
    clientSecret: props.clientSecret
}
const elements = stripe.elements(options);
const paymentElement = elements.create('payment');

onMounted(()=>{

    paymentElement.mount('#payment-element');

});

const makePayment = async () =>{



    const {error} = await stripe.confirmPayment({
        elements,
        confirmParams:{
            return_url: 'http://127.0.0.1:8000/dashboard/checkout/paymentstatus/'
        },
    })

    if(error){
        const messageContainer = document.querySelector('#error-message');
        messageContainer.textContent = error.message;
    }
    else{
        //no need to add anything just for placeholder
    }
}






</script>

<template>

    <AppLayout>
        <div class="max-w-[300px] mx-auto flex h-screen justify-center items-center ">
            <form id="payment-form" class="shadow p-4 pt-0 rounded-lg">




                <div id="payment-element">
                    <!-- Elements will create form elements here -->
                </div>
                <button @click.prevent="makePayment" id="submit" class="bg-blue-800 text-white px-2 py-2 rounded mt-2 w-full">
                    Pay {{currencySymbol}}{{amount}}
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 float-right -ml-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z" />
                    </svg>
                </button>
                <div id="error-message" class="error mt-2 mb-0">
                    <!-- Display error message to your customers here -->
                </div>
            </form>
        </div>
    </AppLayout>

</template>

<style scoped>

</style>
