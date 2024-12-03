import axios from 'axios';
import { TOKEN, API_URL } from '../constant/index.js'; // Import cả TOKEN và API_URL

// Cấu hình axios interceptor để tự động thêm token vào header
axios.interceptors.request.use(
    (config) => {
        const token = getToken();
        if (token) {
            config.headers['Authorization'] = `Bearer ${token}`;
        }
        return config;
    },
    (error) => {
        return Promise.reject(error);
    }
);

// Lấy token từ localStorage
export function getToken() {
    return localStorage.getItem(TOKEN);
}

// Lưu token vào localStorage
export function setToken(token) {
    localStorage.setItem(TOKEN, token);
}

// Xóa token khỏi localStorage
export function removeToken() {
    localStorage.removeItem(TOKEN);
}

// Kiểm tra xem người dùng đã đăng nhập chưa
export function isLoggedIn() {
    return !!getToken();
}

// Hàm đăng nhập
export function login(mail, password) {
    return axios.post(`${API_URL}/login`, {
        mail,
        password
    });
}
export function register(userData) {
    return axios.post(`${API_URL}/register`, {
        full_name: userData.full_name,
        mail: userData.email,
        user_name: userData.user_name,
        password: userData.password,
        job_position_id: userData.position,
        job_created_at: userData.birthdate
    });
}

export function logout() {
    return axios.post(`${API_URL}/logout`)
        .then(() => {
            removeToken();
        });
}