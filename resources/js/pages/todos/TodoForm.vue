<script setup>
import { onMounted, ref, watch } from 'vue'
import TodoApi from '../../api/TodoApi';
import { useRoute, useRouter } from 'vue-router';

const form = ref({
    title: '',
    description: '',
})

const router = useRouter();
const route = useRoute();
const id = route.params.id;

const handleSubmit = async () => {
    const res = await TodoApi.save(form.value);
    if(res.success) {
        router.push('/todos');
    } else {
        alert(res.errors.message);
    }
}

const getTodo = async (id) => {
    const res = await TodoApi.show(id);
    if(res.success) {
        form.value = res.data.data;
    } else {
        alert(res.errors.message);  
    }
}

onMounted(() => {
    if(id) {
        getTodo(id);
    }
})



</script>

<template>
  <div class="min-h-screen flex items-center justify-center bg-gray-50">
    <div class="max-w-md w-full mx-auto p-6 bg-white rounded-lg shadow-md">
      <div class="flex justify-between items-center">
        <h2 class="text-2xl font-semibold mb-4">
          {{ id ? 'Update' : 'Create' }} Todo
        </h2>
        <router-link to="/todos" class="inline-block mb-4 text-blue-600 hover:underline">← Back to Todos</router-link>
      </div>

      <form @submit.prevent="handleSubmit" class="space-y-5">

        <!-- Title -->
        <div>
          <label class="block text-sm font-medium mb-1" for="title">
            Title
          </label>
          <input v-model="form.title" 
            type="text" 
            id="title" 
            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
            placeholder="Enter title"
          />
        </div>

        <!-- Description -->
        <div>
          <label class="block text-sm font-medium mb-1" for="description">
            Description
          </label>
          <textarea v-model="form.description" 
            id="description" 
            rows="4" 
            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
            placeholder="Enter description"
          ></textarea>
        </div>

        <!-- Submit Button -->
        <button 
          type="submit" 
          class="w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700 transition">
          Submit
        </button>
      </form>
    </div>
  </div>
</template>
