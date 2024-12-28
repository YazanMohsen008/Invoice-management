import {createRouter, createWebHistory} from "vue-router";
import Invoice from "./Components/invoice/ShowInvoices.vue"
import NewInvoice from "./Components/invoice/CreateInvoice.vue"
import InvoiceShow from "./Components/invoice/ShowInvoice.vue"
import NotFound from "./Components/NotFound.vue"
import InvoiceEdit from "./Components/invoice/EditInvoice.vue";

const routes = [
    {
        path: '/invoice',
        component: Invoice
    },
    {
        path: '/invoice/new',
        component: NewInvoice
    },
    {
        path: '/invoice/show/:id',
        component: InvoiceShow,
        props: true
    },
    {
        path: '/invoice/edit/:id',
        component: InvoiceEdit,
        props: true
    },
    {
        path: '/:pathMatch(.*)*',
        component: NotFound
    }
]
const router = createRouter({
        history: createWebHistory(),
        routes: routes
    }
)
export default router;
