<template>
    <div class="register">
        <div class="register-container">
            <div class="register-box">
                <h1>注册账户</h1>
                <h2>欢迎注册</h2>
                <form id="register-form" autocomplete="off">
                    <input
                        type="text"
                        name="full-name"
                        :readonly="isReadonly"
                        @focus="removeReadonly"
                        placeholder="请输入您的姓名"
                        autocomplete="off"
                        required
                    />

                    <input
                        type="email"
                        name="email"
                        :readonly="isReadonly"
                        @focus="removeReadonly"
                        placeholder="请输入您的电子邮件"
                        autocomplete="off"
                        required
                    />

                    <input
                        type="text"
                        name="username"
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

                    <select name="position" required>
                        <option value="" disabled selected>请选择您的职位</option>
                        <option value="manager">经理</option>
                        <option value="developer">开发人员</option>
                        <option value="designer">设计师</option>
                        <option value="tester">测试人员</option>
                        <option value="other">其他</option>
                    </select>

                    <input
                        type="date"
                        name="birthdate"
                        :readonly="isReadonly"
                        @focus="removeReadonly"
                        required
                    />

                    <div class="gender">
                        <label>
                            <input type="radio" name="gender" value="male" required />
                            男
                        </label>
                        <label>
                            <input type="radio" name="gender" value="female" required />
                            女
                        </label>
                        <label>
                            <input type="radio" name="gender" value="other" required />
                            其他
                        </label>
                    </div>

                    <button type="submit" class="register-button">注册</button>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
import { ref } from "vue";

export default {
    name: 'Register',
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
