<script setup>
import { ref } from 'vue'
import { useRouter } from 'vue-router'
import AuthApi from '../../api/AuthApi'

const router = useRouter()

const form = ref({
  name: '',
  email: '',
  password: '',
  password_confirmation: '',
})


const handleSubmit = async () => {
    const res = await AuthApi.signup(form.value);
    if(res.success) {
        router.push('/');
    } else {
        alert((res.errors && (res.errors.password?.[0] || res.errors.email?.[0] || res.errors.name?.[0])) || res.message || 'Registration failed');
    }
}
</script>

<template>
  <div class="min-h-screen flex items-center justify-center bg-gray-50">
    <div class="max-w-md w-full mx-auto p-6 bg-white rounded-lg shadow-md">
      <form @submit.prevent="handleSubmit" class="space-y-6">
        <div>
          <label class="block text-gray-700 text-sm font-bold mb-2" for="name">
            Name
          </label>
          <input v-model="form.name" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="name" type="text" placeholder="name">
        </div>
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
          <input v-model="form.password" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="password" type="password" placeholder="******************">
        </div>
        <div>
          <label class="block text-gray-700 text-sm font-bold mb-2" for="password_confirmation">
            Confirm Password
          </label>
          <input v-model="form.password_confirmation" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="password_confirmation" type="password" placeholder="******************">
        </div>
        <div class="flex items-center justify-between">
          <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
            Register
          </button>
        </div>
      </form>
    </div>
  </div>

          
</template>