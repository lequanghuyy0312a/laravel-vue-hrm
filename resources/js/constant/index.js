// Constants cho authentication
export const TOKEN = 'token';
export const API_URL = 'http://127.0.0.1:8000/api/auth';

// Constants cho API endpoints
export const API_ENDPOINTS = {
    LOGIN: '/login',
    REGISTER: '/register',
    LOGOUT: '/logout',
    PROFILE: '/profile'
};

// Constants cho route names
export const ROUTE_NAMES = {
    LOGIN: 'Login',
    REGISTER: 'Register',
    HOME: 'HomePage',
    ERROR: 'Error'
};

// Constants cho messages
export const MESSAGES = {
    LOGIN_SUCCESS: '登录成功',
    LOGIN_FAILED: '登录失败',
    REGISTER_SUCCESS: '注册成功',
    REGISTER_FAILED: '注册失败',
    NETWORK_ERROR: '网络错误',
    UNAUTHORIZED: '未授权访问'
};

// Constants cho validation
export const VALIDATION = {
    USERNAME_MIN: 3,
    USERNAME_MAX: 20,
    PASSWORD_MIN: 6,
    PASSWORD_MAX: 20
};