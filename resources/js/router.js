import {createRouter, createWebHistory} from "vue-router";
import Invoice from "./Components/Invoice.vue"
import NotFound from "./Components/NotFound.vue"

const routes = [
    {
        path: '/invoice',
        component: Invoice
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
