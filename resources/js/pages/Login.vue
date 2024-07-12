<template>
    <form @submit.prevent="loginUser" class="flex flex-col w-1/3">
        <div class="flex flex-col justify-evenly gap-4">
            <div class="flex flex-col">
                <label for="firstName">Email:</label>
                <input v-model="email" type="email" name="email" class="rounded-md border-0 py-1.5 pl-2 pr-2 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 w-full" placeholder="Email">
            </div>

            <div class="flex flex-col">
                <label for="firstName">Confirm Password:</label>
                <input v-model="password" type="password" name="confirmPassword" class="rounded-md border-0 py-1.5 pl-2 pr-2 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 w-full" placeholder="Confirm Password">
            </div>

            <a href="/login">Reload</a>

            <button
                class="bg-gradient-to-r from-indigo-500 to-orange-500 py-2 px-6 border rounded-2xl w-full text-white font-bold" type="submit">Login</button>
        </div>
    </form>
</template>

<script>
export default {
    data() {
        return {
            email: null,
            password: null,
            passwordFailure: false,
        }
    },
    computed: {
        requestParams() {
            return {
                "email": this.email,
                "password": this.password,
            }
        },
    },
    methods: {
        loginUser() {
            console.log(';;;;;;;');

            this.errorMsg = null;
            axios.post('/user/login', this.requestParams)
                .then(response => {
                    console.log(response.data);
                    window.location.href = "/";
                })
                .catch(error => {
                    console.log(error.response.data.message);
                    this.setErrorMessage(error.response.data.message);
                });
        },
        setErrorMessage(msg) {
            this.passwordFailure = true;
            this.errorMsg = msg;

            return true;
        },
    },
    mounted() {
        console.log('asdasdasssddasd');
    },
}
</script>
