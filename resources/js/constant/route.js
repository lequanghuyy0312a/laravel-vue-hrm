import {createRouter, createWebHashHistory } from 'vue-router'

//pages
import HomePage from '@/components/pages/home/index.vue';

//error
import Error from '@/components/pages/error/index.vue';

//login
import Login from '@/components/auth/login.vue';

//Register
import Register from '../components/auth/register.vue';



const router = createRouter({
    history: createWebHashHistory(),
    routes: [
        { path: '/', name: 'Login', component: Login },
        { path: '/home', name: 'HomePage', component: HomePage },
        { path: '/register', name: 'Register', component: Register },
        { path: '/:pathMatch(.*)*', name: 'Error', component: Error },
    ],
});

router.beforeEach((to, from, next) => {
    console.log('Navigating to:', to.path);
    if (to.meta.requiresAuth && !localStorage.getItem('token')) {
        console.log('Redirecting to Login');
        return next({ name: 'Login' });
    }
    if (!to.meta.requiresAuth && localStorage.getItem('token')) {
        console.log('Redirecting to HomePage');
        return next({ name: 'HomePage' });
    }
    next();
});

export default router