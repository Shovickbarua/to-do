<script setup>
import { onMounted, ref } from 'vue';
import ProductApi from '../../api/ProductApi';
import AuthApi from '../../api/AuthApi';
import { useRouter } from 'vue-router';

const products = ref([]);
const router = useRouter();

const getProducts = async () => {
    const res = await ProductApi.index();
    if(res.success) {
        products.value = res.data.data;
    } else {
        alert(res.errors.message);
    }
}

const deleteProduct = async (id) => {
    const res = await ProductApi.delete(id);
    if(res.success) {
        getProducts();
    } else {
        alert(res.errors.message);
    }
}

const logout = async () => {
  const res = await AuthApi.logout();
  if(res.success) {
    localStorage.removeItem('token');
    router.push('/');
  } else {
    alert(res.errors.message);
  }
}

onMounted(() => {
  getProducts();
});

</script>

<template>
  <div class="min-h-screen flex items-center justify-center bg-gray-50 py-8">
    <div class="w-full max-w-4xl mx-auto bg-white rounded-lg shadow-md overflow-hidden">
      <div class="overflow-x-auto">
        <div class="flex justify-between items-center mt-4 mx-4">
          <router-link to="/products/create" class="inline-block mb-4 px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">Create New Product</router-link>
          <button
            @click="logout"
            class="inline-block mb-4 px-4 py-2 bg-gray-200 text-gray-700 rounded hover:bg-gray-300 transition"
          >Logout</button>
        </div>
        <table class="min-w-full divide-y divide-gray-200">
          <thead class="bg-gray-100 whitespace-nowrap">
          <tr>
            <th class="px-4 py-4 text-left text-xs font-semibold text-slate-900 uppercase tracking-wider">
            Title
            </th>
            <th class="px-4 py-4 text-left text-xs font-semibold text-slate-900 uppercase tracking-wider">
            Description
            </th>
            <th class="px-4 py-4 text-left text-xs font-semibold text-slate-900 uppercase tracking-wider">
            Actions
            </th>
          </tr>
          </thead>

          <tbody class="bg-white divide-y divide-gray-200 whitespace-nowrap">
          <tr v-for="product in products" :key="product.id">
            <td class="px-4 py-4 text-sm text-slate-900 font-medium">
            {{ product.title }}
            </td>
            <td class="px-4 py-4 text-sm text-slate-600 font-medium">
            {{ product.description }}
            </td>
            <td class="px-4 py-4 text-sm">
            <router-link :to="`/products/edit/${product.id}`" class="cursor-pointer text-blue-600 font-medium mr-4">Edit</router-link>
            <button class="cursor-pointer text-red-600 font-medium" @click="deleteProduct(product.id)">Delete</button>
            </td>
          </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</template>
