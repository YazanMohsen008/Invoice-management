require('./bootstrap');
import {createApp} from "vue";
import app from './Components/app.vue'
import router from "./router";

createApp(app).use(router).mount("#app");
