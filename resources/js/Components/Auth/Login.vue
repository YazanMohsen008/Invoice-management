<script setup>
import {ref} from 'vue';
import {useRouter} from 'vue-router';
import Slider from "./Slider.vue";

let router = useRouter();
let email = ref([]);
let password = ref([]);

const login = async () => {
    let customer = new FormData()
    customer.append("email", email.value);
    customer.append("password", password.value);
    let response = await axios.post("/api/login", customer);
    const token = response.data.token;
    localStorage.setItem("token", token);
    router.push("/invoices");
};

</script>
<template>
    <div class="d-flex overflow-hidden h-100 ">
        <div class="w-75 ">
            <Slider/>
            <!--            <img class="w-100" src="../../../images/6.jpg">-->
        </div>
        <div class="p-3  d-flex flex-column justify-content-between align-items-center">
            <img style="height:400px; width:400px" src="../../../images/11.png">
            <h1 class="text-primary">
                Invoicer Application
            </h1>
            <h4 class="text-secondary">
                Your Gateway To Business Management
            </h4>
            <div class="h-25">
                <input class="p-2 mb-1 w-100 h-25" v-model="email" type="email" placeholder="Email" required>
                <input class="h-25 w-100  p-2 mb-1" v-model="password" type="password" placeholder="Password" required>
                <div class="d-flex  justify-content-end w-100 h-25">
                    <button class="fs-4 w-50 border-0 bg-warning text-light" @click="login()"> Login</button>
                </div>
            </div>
        </div>
    </div>

</template>
