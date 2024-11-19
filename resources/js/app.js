import './bootstrap';

import { createApp } from 'vue'
import Router from './constant/route.js'
import App from './App.vue'

const app = createApp(App)
app.use(Router);
app.mount('#app');