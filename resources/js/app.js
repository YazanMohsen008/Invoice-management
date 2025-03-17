require('./bootstrap');
import {createApp} from "vue";
import app from './Components/app.vue'
import router from "./router";
import ToastPlugin from 'vue-toast-notification';
import 'vue-toast-notification/dist/theme-bootstrap.css';


createApp(app).use(router).use(ToastPlugin).mount("#app");
