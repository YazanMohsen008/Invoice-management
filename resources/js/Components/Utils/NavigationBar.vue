<script setup>
import {useRouter} from "vue-router";

const router = useRouter();
const newInvoice = () => {
    router.push("/Invoice/new");
}
const invoices = () => {
    router.push("/invoices");
}
const aboutUS = () => {
    router.push("/AboutUs");
}
const contactUS = () => {
    router.push("/ContactUs");
}
const logout = () => {
    router.push("/");
}
</script>
<template>
    <div class="d-flex w-100 justify-content-around align-items-center bg-primary text-white p-2">
        <a class="d-flex flex-grow-1  align-items-center text-white text-decoration-none" href="#" @click="invoices()">
            <img src="../../../images/11.png" width="100px" height="100px">
            <div>Invoicer Application</div>
        </a>
        <div class="d-flex justify-content-around flex-grow-1">
            <a class="text-white text-decoration-none" href="#" @click="newInvoice()">New Invoice</a>
            <a class="text-white text-decoration-none" href="#" @click="invoices()">My Invoices</a>
            <a class="text-white text-decoration-none" href="#" @click="aboutUS()">About US</a>
            <a class="text-white text-decoration-none" href="#" @click="contactUS()">Contact US</a>
        </div>
        <div class="d-flex  justify-content-end flex-grow-1 align-items-center">
            <a href="#">
                <img src="../../../images/12.png" width="100px" height="100px"></a>

            <a class="text-white text-decoration-none" href="#" @click="logout()"><i
                class="bi-box-arrow-right fs-1 m-4"></i></a>

        </div>
    </div>
</template>
