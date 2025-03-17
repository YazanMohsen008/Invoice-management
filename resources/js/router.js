import {createRouter, createWebHistory} from "vue-router";
import Login from "./Components/Auth/Login.vue"
import AllInvoice from "./Components/Invoice/ShowInvoices.vue"
import NewInvoice from "./Components/Invoice/CreateInvoice.vue"
import InvoiceShow from "./Components/Invoice/ShowInvoice.vue"
import NotFound from "./Components/NotFound.vue"
import InvoiceEdit from "./Components/Invoice/EditInvoice.vue";
import AboutUs from "./Components/Extra/AboutUs.vue";
import ContactUs from "./Components/Extra/ContactUs.vue";

const routes = [
    {
        path: '/',
        component: Login
    },
    {
        path: '/invoices',
        component: AllInvoice
    },
    {
        path: '/Invoice/new',
        component: NewInvoice
    },
    {
        path: '/Invoice/show/:id',
        component: InvoiceShow,
        props: true
    },
    {
        path: '/Invoice/edit/:id',
        component: InvoiceEdit,
        props: true
    },
    {
        path: '/AboutUs',
        component: AboutUs,
    },
    {
        path: '/ContactUs',
        component: ContactUs,
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
