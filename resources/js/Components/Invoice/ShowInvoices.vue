<script setup>
import {onMounted, ref} from "vue";
import {useRouter} from "vue-router";
import NavigationBar from "../Utils/NavigationBar.vue";

const router= useRouter();
let invoices = ref([]);
let searchInvoice = ref([]);
onMounted(
    async () => {
        getInvoices()
    }
)
const getInvoices = async () => {
    let response = await axios.get("/api/invoice/all");
    // console.log(response);
    invoices.value = response.data;

}
const search = async () => {
    let response = await axios.get("/api/invoice/search?s=" + searchInvoice.value)
    invoices.value = response.data;
}
const newInvoice = ()=>{
    router.push("/Invoice/new");
}
const onShow = (id)=> {
    router.push("/Invoice/show/"+id);
}

</script>
<template>
    <NavigationBar></NavigationBar>
    <div class="">
        <!--==================== INVOICE LIST ====================-->
        <div class="invoices">

<!--            <div class="card__header">-->
<!--                <div>-->
<!--                    <h2 class="invoice__title">Invoices</h2>-->
<!--                </div>-->
<!--                <div>-->
<!--                    <a class="btn btn-secondary" @click="newInvoice()">-->
<!--                        New Invoice-->
<!--                    </a>-->
<!--                </div>-->
<!--            </div>-->

            <div class="table card__content">
<!--                <div class="table&#45;&#45;filter">-->
<!--                <span class="table&#45;&#45;filter&#45;&#45;collapseBtn ">-->
<!--                    <i class="fas fa-ellipsis-h"></i>-->
<!--                </span>-->
<!--                    <div class="table&#45;&#45;filter&#45;&#45;listWrapper">-->
<!--                        <ul class="table&#45;&#45;filter&#45;&#45;list">-->
<!--                            <li>-->
<!--                                <p class="table&#45;&#45;filter&#45;&#45;link table&#45;&#45;filter&#45;&#45;link&#45;&#45;active">-->
<!--                                    All-->
<!--                                </p>-->
<!--                            </li>-->
<!--                            <li>-->
<!--                                <p class="table&#45;&#45;filter&#45;&#45;link ">-->
<!--                                    Paid-->
<!--                                </p>-->
<!--                            </li>-->
<!--                        </ul>-->
<!--                    </div>-->
<!--                </div>-->

                <div class="table--search">
                    <div class="table--search--wrapper">
                        <select class="table--search--select" name="" id="">
                            <option value="">Filter</option>
                        </select>
                    </div>
                    <div class="relative">
                        <i class="table--search--input--icon fas fa-search "></i>
                        <input class="table--search--input" type="text" placeholder="Search invoice"
                               v-model="searchInvoice" @keyup="search()">
                    </div>
                </div>

                <div class="table--heading">
                    <p>ID</p>
                    <p>Date</p>
                    <p>Number</p>
                    <p>Customer</p>
                    <p>Due Date</p>
                    <p>Total</p>
                </div>

                <!-- item 1 -->
                <div class="table--items" v-for="item in invoices" :key="item.id" v-if="invoices.length>0">
                    <a href="#" @click="onShow(item.id)" class="table--items--transactionId">#{{ item.id }}</a>
                    <p>{{ item.date }}</p>
                    <p>#{{ item.number }}</p>
                    <p v-if="item.customer">{{ item.customer.firstname }}</p>
                    <p>{{ item.due_date }}</p>
                    <p> $ {{ item.total }}</p>
                </div>
                <div class="table--items" v-else>
                    Invoice Not Found
                </div>
            </div>

        </div>

    </div>

</template>
