<script setup>
import {onMounted, ref} from 'vue'
import {useRouter} from "vue-router";

const router = useRouter();

let invoice = ref([]);
invoice.value.discount = ref(0);
let customers = ref([]);

let item = ref([]);
let cart = ref([]);
let products = ref([]);

onMounted(
    async () => {
        getCustomers();
    }
)
const getCustomers = async () => {
    let response = await axios.get("/api/customers/all");
    customers.value = response.data;
}


let showModal = ref(false);
let hideModal = ref(true);

let openModal = async () => {
    let response = await axios.get('/api/products/all');
    products.value = response.data;
    showModal.value = !showModal.value
}
let closeModal = () => {
    showModal.value = !hideModal.value
}

let addItemToCart = (product) => {
    product.quantity = 1;
    cart.value.push(product);
    closeModal();
}
let removeItemFromCart = (product) => {
    cart.value.splice(product, 1);
}
let subTotal = () => {
    let total = 0;
    cart.value.map(product => {
        total += product.unit_price * product.quantity
    })
    return total;
}
let total = () => {
    return subTotal() - invoice.value.discount;
}
let onSave = () => {
    let payload= new FormData();
    payload.append("number",invoice.value.number);
    payload.append("customer_id",invoice.value.customer_id);
    payload.append("date",invoice.value.date);
    payload.append("due_date",invoice.value.due_date);
    payload.append("reference",invoice.value.reference);
    payload.append("terms_and_conditions",invoice.value.terms_and_conditions);
    payload.append("sub_total",subTotal());
    payload.append("discount",invoice.value.discount);
    payload.append("total",total());
    payload.append("invoice_items",JSON.stringify(cart.value));
    axios.post("/api/invoice/add", payload);
    router.push("/invoice");
}

</script>
<template>
    <br><br><br>
    <div class="invoices">

        <div class="card__header">
            <div>
                <h2 class="invoice__title">New Invoice</h2>
            </div>
            <div>

            </div>
        </div>

        <div class="card__content">
            <div class="card__content--header">
                <div>
                    <p class="my-1">Customer</p>
                    <select name="" id="" class="input" v-model="invoice.customer_id">
                        <option disabled>Select a Customer</option>
                        <option v-for="customer in customers" :key="customer.id" :value="customer.id">
                            {{ customer.firstname }}
                        </option>
                    </select>
                </div>
                <div>
                    <p class="my-1">Date</p>
                    <input id="date" placeholder="dd-mm-yyyy" type="date" class="input" v-model="invoice.date"> <!---->
                    <p class="my-1">Due Date</p>
                    <input id="due_date" type="date" class="input" v-model="invoice.due_date">
                </div>
                <div>
                    <p class="my-1">Numero</p>
                    <input type="text" class="input" v-model="invoice.number">
                    <p class="my-1">Reference(Optional)</p>
                    <input type="text" class="input" v-model="invoice.reference">
                </div>
            </div>
            <br><br>
            <div class="table">

                <div class="table--heading2">
                    <p>Item Description</p>
                    <p>Unit Price</p>
                    <p>Qty</p>
                    <p>Total</p>
                    <p></p>
                </div>

                <!-- item 1 -->
                <div class="table--items2" v-for="(item,i) in cart" :key="item.id">
                    <p>#{{ item.item_code }} {{ item.description }}</p>
                    <p>
                        <input type="text" class="input" v-model="item.unit_price">
                    </p>
                    <p>
                        <input type="text" class="input" v-model="item.quantity">
                    </p>
                    <p v-if="item.quantity">
                        $ {{ (item.unit_price) * (item.quantity) }}
                    </p>
                    <p v-else></p>

                    <p style="color: red; font-size: 24px;cursor: pointer;" @click="removeItemFromCart(i)">
                        &times;
                    </p>
                </div>
                <div style="padding: 10px 30px !important;">
                    <button class="btn btn-sm btn__open--modal" @click="openModal()">Add New Line</button>
                </div>
            </div>

            <div class="table__footer">
                <div class="document-footer">
                    <p>Terms and Conditions</p>
                    <textarea cols="50" rows="7" class="textarea" v-model="invoice.terms_and_conditions"></textarea>
                </div>
                <div>
                    <div class="table__footer--subtotal">
                        <p>Sub Total</p>
                        <span>$ {{ subTotal() }}</span>
                    </div>
                    <div class="table__footer--discount">
                        <p>Discount</p>
                        <input type="text" class="input" v-model="invoice.discount">
                    </div>
                    <div class="table__footer--total">
                        <p>Grand Total</p>
                        <span>$  {{ total() }}</span>
                    </div>
                </div>
            </div>


        </div>
        <div class="card__header" style="margin-top: 40px;">
            <div>

            </div>
            <div>
                <a class="btn btn-secondary" @click="onSave()">
                    Save
                </a>
            </div>
        </div>

    </div>
    <div class="modal main__modal " :class="{show:showModal}">
        <div class="modal__content">
            <span class="modal__close btn__close--modal" @click="closeModal()">×</span>
            <h3 class="modal__title">Add Item</h3>
            <hr>
            <br>
            <!--            <div class="modal__items">-->
            <!--                <select class="input my-1">-->
            <!--                    <option value="None">None</option>-->
            <!--                    <option value="product.id" :key="product.id" v-for="product in products">{{product.item_code}} {{product.description}}</option>-->
            <!--                </select>-->
            <!--            </div> -->
            <div class="modal__items">
                <ul class="input my-1">
                    <li value="product.id" :key="product.id" v-for="product in products">{{ product.item_code }}
                        {{ product.description }}
                        <button class="btn btn-light btn__close--modal " @click="addItemToCart(product)">+</button>
                    </li>
                </ul>
            </div>
            <br>
            <hr>
            <div class="model__footer">
                <button class="btn btn-light mr-2 btn__close--modal" @click="closeModal()">
                    Cancel
                </button>
                <!--                <button class="btn btn-light btn__close&#45;&#45;modal " @click="addItemToCart()">Save</button>-->
            </div>
        </div>
    </div>
    <br><br><br>

</template>
