<template>
    <form class="flex flex-col w-1/3" @submit.prevent="registerUser">
        <div class="flex flex-col justify-evenly gap-4">
            <div class="flex flex-col">
                <label for="firstName">First Name:</label>
                <input required v-model="firstName" type="text" name="firstName" class="rounded-md border-0 py-1.5 pl-2 pr-2 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 w-full" placeholder="First Name">
            </div>

            <div class="flex flex-col">
                <label for="lastName">Last Name:</label>
                <input required v-model="lastName" type="text" name="lastName" class="rounded-md border-0 py-1.5 pl-2 pr-2 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 w-full" placeholder="Last Name">
            </div>

            <div class="flex flex-col">
                <label for="email">Email:</label>
                <input required v-model="email" type="email" name="email" class="rounded-md border-0 py-1.5 pl-2 pr-2 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 w-full" placeholder="Email">
            </div>

            <div class="flex flex-col">
                <label for="password">Password:</label>
                <input required v-model="password" type="password" name="password" class="rounded-md border-0 py-1.5 pl-2 pr-2 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 w-full" placeholder="Password">
            </div>

            <div class="flex flex-col">
                <label for="confirmPassword">Confirm Password:</label>
                <input required v-model="confirmPassword" type="password" name="confirmPassword" class="rounded-md border-0 py-1.5 pl-2 pr-2 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 w-full" placeholder="Confirm Password">
            </div>

            <div v-if="errorMsg" class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                <strong class="font-bold">{{ errorMsg }}</strong>
            </div>

            <button
                class="bg-gradient-to-r from-indigo-500 to-orange-500 py-2 px-6 border rounded-2xl w-full text-white font-bold" type="submit">Register</button>
        </div>
    </form>
</template>

<script>
export default {
    data() {
        return {
            firstName: null,
            lastName: null,
            email: null,
            password: null,
            confirmPassword: null,
            passwordFailure: false,
            errorMsg: null
        }
    },
    computed: {
        requestParams() {
            return {
                "firstName": this.firstName,
                "lastName": this.lastName,
                "email": this.email,
                "password": this.password,
            }
        },
        passwordCheck() {
            return this.password === this.confirmPassword;
        },
    },
    methods: {
        registerUser() {
            if (!this.passwordCheck) {
                console.log('passwords do not match');
                this.setErrorMessage('Passwords do not match. Please try again!');
                return;
            }
            this.errorMsg = null;
            axios.post('/user/register', this.requestParams)
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
    },
}
</script>
