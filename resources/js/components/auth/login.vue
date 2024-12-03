<template>
    <div class="login">
        <div class="login-container">
            <div class="login-box">
                <h1>我心向六便士</h1>
                <h2>欢迎登陆</h2>
                <form @submit.prevent="handleSubmit" id="login-form" autocomplete="off">
                    <div v-if="error" class="error-message">{{ error }}</div>
                    <input
                        v-model="formData.mail"
                        type="text"
                        name="mail"
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
                    <router-link to="/register">Go to Register</router-link>
                    <button 
                        type="submit" 
                        class="login-button"
                        :disabled="loading"
                    >
                        {{ loading ? '登录中...' : '登 录' }}
                    </button>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
import { ref, reactive } from "vue";
import { useRouter } from 'vue-router';
import { login, setToken } from '@/utils/auth';

export default {
    setup() {
        const router = useRouter();
        const isReadonly = ref(true);
        const loading = ref(false);
        const error = ref('');

        const formData = reactive({
            mail: '',
            password: ''
        });

        const removeReadonly = () => {
            isReadonly.value = false;
        };

        const handleSubmit = async () => {
            try {
                loading.value = true;
                error.value = '';
                
                const response = await login(formData.mail, formData.password);
                
                if (response.data.success) {
                    setToken(response.data.token);
                    router.push('/home');
                    console.log(response.data.message);
                } else {
                    error.value = response.data.message || '登录失败';
                }
            } catch (err) {
                error.value = err.response?.data?.message || '登录时发生错误';
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
