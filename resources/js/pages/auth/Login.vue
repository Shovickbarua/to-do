<script setup>
import { ref } from 'vue';
import AuthApi from '../../api/AuthApi';
import { useRouter } from 'vue-router';

const form = ref({
    email: '',
    password: '',
})

const router = useRouter();

const handleSubmit = async () => {
    const res = await AuthApi.login(form.value);
    if(res.success) {
        localStorage.setItem('token', res.data.token);
        router.push('/products');
    } else {
        alert(res.errors.message);
    }
}
</script>

<template>
  <div class="min-h-screen flex items-center justify-center bg-gray-50">
    <div class="max-w-md w-full mx-auto p-6 bg-white rounded-lg shadow-md">
      <form @submit.prevent="handleSubmit" class="space-y-6">
        <div>
          <label class="block text-gray-700 text-sm font-bold mb-2" for="email">
            Email
          </label>
          <input v-model="form.email" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="email" type="text" placeholder="email">
        </div>
        <div>
          <label class="block text-gray-700 text-sm font-bold mb-2" for="password">
            Password
          </label>
          <input v-model="form.password" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" id="password" type="password" placeholder="******************">
        </div>
        <div class="flex items-center justify-between">
          <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
            Sign In
          </button>
          <router-link to="/register" class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800">
            Register
          </router-link>
        </div>
      </form>
    </div>
  </div>
</template>
