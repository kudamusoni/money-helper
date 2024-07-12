import { createApp } from "vue";

import './bootstrap';

import Home from './pages/Home.vue'
import Login from './pages/Login.vue'
import Register from './pages/Register.vue'

const app = createApp({});
app
    .component('Home', Home)
    .component('Login', Login)
    .component('Register', Register)

app.mount("#app");
