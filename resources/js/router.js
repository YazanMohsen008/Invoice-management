import {createRouter, createWebHistory} from "vue-router";
import Invoice from "./Components/invoice/Invoice.vue"
import NewInvoice from "./Components/invoice/new.vue"
import NotFound from "./Components/NotFound.vue"

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
