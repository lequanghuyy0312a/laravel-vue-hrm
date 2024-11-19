<template>
    <div class="login">
        <div class="login-container">
            <div class="login-box">
                <h1>我心向六便士</h1>
                <h2>欢迎登陆</h2>
                <form id="login-form" autocomplete="off">
                    <input
                        type="email"
                        name="fake-email"
                        :readonly="isReadonly"
                        @focus="removeReadonly"
                        placeholder="请输入您的用户名"
                        autocomplete="off"
                        required
                    />
                    <input
                        type="password"
                        name="password"
                        :readonly="isReadonly"
                        @focus="removeReadonly"
                        placeholder="请输入密码"
                        autocomplete="off"
                        required
                    />
                    <router-link to="/register">Go to Register</router-link>
                    <button type="submit" class="login-button">登 录</button>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
import { ref } from "vue";

export default {
    setup() {
        const isReadonly = ref(true);

        const removeReadonly = () => {
            isReadonly.value = false;
        };

        return {
            isReadonly,
            removeReadonly,
        };
    },
};
</script>

<style>

</style>
