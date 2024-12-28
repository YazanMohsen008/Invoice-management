<script setup>
import {onMounted, ref} from "vue";
import {useRouter} from "vue-router";

const router= useRouter();
let invoice = ref({id:''});

const props= defineProps({
    id:{
        type:String,
        default:''
    }
});
onMounted(
    async () => {
        getInvoiceById()
    }
)
const getInvoiceById = async () => {
    let response = await axios.get("/api/invoice/"+props.id);
    invoice.value = response.data;

}
const print = ()=>{
    window.print();
    router.push("/invoice");
}
const edit = ()=>{
    router.push("/invoice/edit/"+props.id);
}
const deleteInvoice =async ()=>{
   await axios.get("/api/invoice/delete/"+props.id);
    router.push("/invoice");
}

</script>
<template>
    <div class="container">

        <div class="invoices">

            <div class="card__header">
                <div>
                    <h2 class="invoice__title">Invoice</h2>
                </div>
                <div>

                </div>
            </div>
            <div>
                <div class="card__header--title ">
                    <h1 class="mr-2">#{{invoice.id}}</h1>
                    <p>{{invoice.created_at}} </p>
                </div>

                <div>
                    <ul class="card__header-list">
                        <li>
                            <!-- Select Btn Option -->
                            <button @click="print()" class="selectBtnFlat">
                                <i class="fas fa-print"></i>
                                Print
                            </button>
                            <!-- End Select Btn Option -->
                        </li>
                        <li>
                            <!-- Select Btn Option -->
                            <button class="selectBtnFlat" @click="edit()">
                                <i class=" fas fa-reply"></i>
                                Edit
                            </button>
                            <!-- End Select Btn Option -->
                        </li>
                        <li>
                            <!-- Select Btn Option -->
                            <button class="selectBtnFlat " @click="deleteInvoice()">
                                <i class=" fas fa-pencil-alt"></i>
                                Delete
                            </button>
                            <!-- End Select Btn Option -->
                        </li>

                    </ul>
                </div>
            </div>

            <div class="table invoice">
                <div class="logo">
                    <img src="assets/img/logo.png" alt="" style="width: 200px;">
                </div>
                <div class="invoice__header--title">
                    <p></p>
                    <p class="invoice__header--title-1">Invoice</p>
                    <p></p>
                </div>


                <div class="invoice__header--item">
                    <div>
                        <h2>Invoice To:</h2>
                        <p v-if="invoice.customer">{{invoice.customer.firstname}}</p>
                    </div>
                    <div>
                        <div class="invoice__header--item1">
                            <p>Invoice#</p>
                            <span>#{{invoice.number}}</span>
                        </div>
                        <div class="invoice__header--item2">
                            <p>Date</p>
                            <span>{{invoice.date}}</span>
                        </div>
                        <div class="invoice__header--item2">
                            <p>Due Date</p>
                            <span>{{invoice.due_date}}</span>
                        </div>
                        <div class="invoice__header--item2">
                            <p>Reference</p>
                            <span>{{invoice.reference}}</span>
                        </div>

                    </div>
                </div>

                <div class="table py1">

                    <div class="table--heading3">
                        <p>#</p>
                        <p>Item Description</p>
                        <p>Unit Price</p>
                        <p>Qty</p>
                        <p>Total</p>
                    </div>
                    <div class="table&#45;&#45;items3" v-for="item in invoice.items" :key="item.id" >
                        <p>{{ item.id }}</p>
                        <p>{{ item.product.description }}</p>
                        <p>{{ item.unit_price }}</p>
                        <p>{{ item.quantity }}</p>
                        <p>{{( item.unit_price ) *(item.quantity )}}</p>
                    </div>
                </div>

                <div class="invoice__subtotal">
                    <div>
                        <h2>Thank you for your business</h2>
                    </div>
                    <div>
                        <div class="invoice__subtotal--item1">
                            <p>Sub Total</p>
                            <span> $ {{invoice.sub_total}}</span>
                        </div>
                        <div class="invoice__subtotal--item2">
                            <p>Discount</p>
                            <span> $ {{invoice.discount}}</span>
                        </div>

                    </div>
                </div>

                <div class="invoice__total">
                    <div>
                        <h2>Terms and Conditions</h2>
                        <p>{{invoice.terms_and_conditions}}</p>
                    </div>
                    <div>
                        <div class="grand__total">
                            <div class="grand__total--items">
                                <p>Grand Total</p>
                                <p>{{invoice.total}}</p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="card__footer">
                <div>

                </div>
                <div>
                    <a class="btn btn-secondary">
                        Save
                    </a>
                </div>
            </div>

        </div>

    </div>

</template>
