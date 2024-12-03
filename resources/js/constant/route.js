import { createRouter, createWebHashHistory } from 'vue-router';
import { TOKEN } from './index.js';
import { removeToken } from '../utils/auth'; // Import thêm removeToken

// Pages
import HomePage from '@/components/pages/home/index.vue';
import Login from '@/components/auth/login.vue';
import Register from '../components/auth/register.vue';
import Error from '@/components/pages/error/index.vue';

const routes = [{
        path: '/',
        name: 'Login',
        component: Login,
        meta: { requiresAuth: false, title: '登录' }
    },
    {
        path: '/home',
        name: 'HomePage',
        component: HomePage,
        meta: { requiresAuth: true, title: '首页' }
    },
    {
        path: '/register',
        name: 'Register',
        component: Register,
        meta: { requiresAuth: false, title: '注册' }
    },
    {
        path: '/logout',
        name: 'Logout',
        beforeEnter: (to, from, next) => {
            removeToken();
            next({ name: 'Login' });
        }
    },
    {
        path: '/:pathMatch(.*)*',
        name: 'Error',
        component: Error,
        meta: { title: '404' }
    },
];

const router = createRouter({
    history: createWebHashHistory(),
    routes,
});

router.beforeEach((to, from, next) => {
    document.title = to.meta.title ? `${to.meta.title} - 我心向六便士` : '我心向六便士';

    const token = localStorage.getItem(TOKEN);

    if (to.meta.requiresAuth && !token) {
        return next({ name: 'Login' });
    }

    if ((to.name === 'Login' || to.name === 'Register') && token) {
        return next({ name: 'HomePage' });
    }

    next();
});

export default router;