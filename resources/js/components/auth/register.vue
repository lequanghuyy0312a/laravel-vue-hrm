<template>
    <div class="register">
        <div class="register-container">
            <div class="register-box">
                <h1>注册账户</h1>
                <h2>欢迎注册</h2>
                <form @submit.prevent="handleSubmit" id="register-form" autocomplete="off">
                    <div v-if="error" class="error-message">{{ error }}</div>
                    
                    <input
                        v-model="formData.full_name"
                        type="text"
                        name="full-name"
                        :readonly="isReadonly"
                        @focus="removeReadonly"
                        placeholder="请输入您的姓名"
                        autocomplete="off"
                        required
                    />

                    <input
                        v-model="formData.email"
                        type="email"
                        name="email"
                        :readonly="isReadonly"
                        @focus="removeReadonly"
                        placeholder="请输入您的电子邮件"
                        autocomplete="off"
                        required
                    />

                    <input
                        v-model="formData.user_name"
                        type="text"
                        name="username"
                        :readonly="isReadonly"
                        @focus="removeReadonly"
                        placeholder="请输入您的用户名"
                        autocomplete="off"
                        required
                    />

                    <input
                        v-model="formData.password"
                        type="password"
                        name="password"
                        :readonly="isReadonly"
                        @focus="removeReadonly"
                        placeholder="请输入密码"
                        autocomplete="off"
                        required
                    />

                    <select v-model="formData.position" name="position" required>
                        <option value="" disabled selected>请选择您的职位</option>
                        <option value="1">经理</option>
                        <option value="2">开发人员</option>
                        <option value="3">设计师</option>
                        <option value="4">测试人员</option>
                        <option value="4">其他</option>
                    </select>

                    <input
                        v-model="formData.birthdate"
                        type="date"
                        name="birthdate"
                        :readonly="isReadonly"
                        @focus="removeReadonly"
                        required
                    />

                    <div class="gender">
                        <label>
                            <input type="radio" v-model="formData.gender" name="gender" value="male" required />
                            男
                        </label>
                        <label>
                            <input type="radio" v-model="formData.gender" name="gender" value="female" required />
                            女
                        </label>
                        <label>
                            <input type="radio" v-model="formData.gender" name="gender" value="other" required />
                            其他
                        </label>
                    </div>

                    <router-link to="/">返回登录</router-link>
                    
                    <button 
                        type="submit" 
                        class="register-button"
                        :disabled="loading"
                    >
                        {{ loading ? '注册中...' : '注 册' }}
                    </button>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
import { ref, reactive } from "vue";
import { useRouter } from 'vue-router';
import { register, login, setToken } from '@/utils/auth';
import { MESSAGES } from '@/constant/index.js';

export default {
    setup() {
        const router = useRouter();
        const isReadonly = ref(true);
        const loading = ref(false);
        const error = ref('');

        const formData = reactive({
            full_name: '',
            email: '',
            user_name: '',
            password: '',
            position: '',
            birthdate: '',
            gender: ''
        });

        const removeReadonly = () => {
            isReadonly.value = false;
        };

        const handleSubmit = async () => {
            try {
                loading.value = true;
                error.value = '';
                
                const registerResponse = await register(formData);
                
                if (registerResponse.data.success) {
                    const loginResponse = await login(formData.email, formData.password);
                    
                    if (loginResponse.data.success) {
                        setToken(loginResponse.data.token);
                        router.push('/home');
                    } else {
                        error.value = loginResponse.data.message || MESSAGES.LOGIN_FAILED;
                    }
                } else {
                    error.value = registerResponse.data.message || MESSAGES.REGISTER_FAILED;
                }
            } catch (err) {
                error.value = err.response?.data?.message || MESSAGES.NETWORK_ERROR;
            } finally {
                loading.value = false;
            }
        };

        return {
            isReadonly,
            removeReadonly,
            formData,
            handleSubmit,
            loading,
            error
        };
    },
};
</script>

<style>

</style>
