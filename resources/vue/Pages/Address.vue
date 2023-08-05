<script setup>
import AppLayout from "../layouts/App.vue";
import { useForm } from '@inertiajs/vue3'
const props = defineProps({
    productId:String|Number,
    address: String,
    postalCode: String,
    city: String,
    state: String,
    country: String,
})
const form = useForm({
    productId:props.productId,
    address:props.address || null ,
    postalCode:props.postalCode || null,
    city:props.city || null,
    state:props.state || null,
    country:props.country ||null,
});



const countries = [{ name: 'Australia', code: 'AU' },
    { name: 'Austria', code: 'AT' },
    { name: 'Belgium', code: 'BE' },
    { name: 'Brazil', code: 'BR' },
    { name: 'Bulgaria', code: 'BG' },
    { name: 'Canada', code: 'CA' },
    { name: 'Croatia', code: 'HR' },
    { name: 'Cyprus', code: 'CY' },
    { name: 'Czech Republic', code: 'CZ' },
    { name: 'Denmark', code: 'DK' },
    { name: 'Estonia', code: 'EE' },
    { name: 'Finland', code: 'FI' },
    { name: 'France', code: 'FR' },
    { name: 'Germany', code: 'DE' },
    { name: 'Gibraltar', code: 'GI' },
    { name: 'Greece', code: 'GR' },
    { name: 'Hong Kong', code: 'HK' },
    { name: 'Hungary', code: 'HU' },
    { name: 'India', code: 'IN' },
    { name: 'Indonesia', code: 'ID' },
    { name: 'Ireland', code: 'IE' },
    { name: 'Italy', code: 'IT' },
    { name: 'Japan', code: 'JP' },
    { name: 'Latvia', code: 'LV' },
    { name: 'Liechtenstein', code: 'LI' },
    { name: 'Lithuania', code: 'LT' },
    { name: 'Luxembourg', code: 'LU' },
    { name: 'Malaysia', code: 'MY' },
    { name: 'Malta', code: 'MT' },
    { name: 'Mexico', code: 'MX' },
    { name: 'Netherlands', code: 'NL' },
    { name: 'New Zealand', code: 'NZ' },
    { name: 'Norway', code: 'NO' },
    { name: 'Poland', code: 'PL' },
    { name: 'Portugal', code: 'PT' },
    { name: 'Romania', code: 'RO' },
    { name: 'Singapore', code: 'SG' },
    { name: 'Slovakia', code: 'SK' },
    { name: 'Slovenia', code: 'SI' },
    { name: 'Spain', code: 'ES' },
    { name: 'Sweden', code: 'SE' },
    { name: 'Switzerland', code: 'CH' },
    { name: 'Thailand', code: 'TH' },
    { name: 'United Arab Emirates', code: 'AE' },
    { name: 'United Kingdom', code: 'GB' },
    { name: 'United States', code: 'US' }
];
const csrfToken = document.head.querySelector('meta[name="csrf-token"]').content;
</script>

<template>
    <AppLayout>
        <div class="max-w-[300px] mx-auto flex h-screen justify-center items-center ">
            <form @submit.prevent="form.post('/dashboard/checkout/addaddress')" class="shadow p-4 rounded-lg">
                <input type="hidden" name="_token" :value="csrfToken"/>
                <input type="hidden" name="productId" :value="productId">
                <span class="mb-2 block">Billing Address</span>
                <label for="address " class="mb-1">Address Line*</label>
               <input id="address" class="rounded mb-2 border-gray-200 w-full" placeholder="" type="text" v-model="form.address" name="address" required/>
                <div v-if="form.errors.address" class="error">{{form.errors.address}}</div>
                <label for="postalCode" class="mb-1">Postal/Zip Code*</label>
               <input id="postalCode" class="rounded mb-2 border-gray-200 w-full" placeholder="" type="text" v-model="form.postalCode" name="postalCode" required/>
                <div v-if="form.errors.postalCode" class="error">{{form.errors.postalCode}}</div>
                <label for="city" class="mb-1">City*</label>
               <input id="city" class="rounded mb-2 border-gray-200 w-full" placeholder="" type="text" v-model="form.city" name="city" required/>
                <div v-if="form.errors.city" class="error">{{form.errors.city}}</div>
                <label for="state" class="mb-1">State*</label>
               <input id="state" class="rounded mb-2 border-gray-200 w-full" placeholder="" type="text" v-model="form.state" name="state" required/>
                <div v-if="form.errors.state" class="error">{{form.errors.state}}</div>
                <label for="country"  class="mb-1">Country*</label>
                <select id="country" name="country" class="rounded mb-2 border-gray-200 w-full" v-model="form.country" required>
                    <option v-for="country in countries" :key="country.code" :value="country.code">{{country.name}}</option>
                </select>
                <div v-if="form.errors.country" class="error">{{form.errors.country}}</div>
                <button @clik.prevent="form.post('/dashboard/checkout/addaddress')" class="bg-blue-800 text-white px-2 py-2 rounded mt-2 w-full cursor-pointer" >Next<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 -ml-6 float-right">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17.25 8.25L21 12m0 0l-3.75 3.75M21 12H3" />
                </svg>
                </button>
            </form>
        </div>
    </AppLayout>
</template>
