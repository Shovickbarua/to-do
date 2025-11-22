<script setup>
import { onMounted, ref } from 'vue';
import TodoApi from '../../api/TodoApi';
import AuthApi from '../../api/AuthApi';
import { useRouter } from 'vue-router';

const todos = ref([]);
const router = useRouter();

const getTodos = async () => {
    const res = await TodoApi.index();
    if(res.success) {
        todos.value = res.data.data;
    } else {
        alert(res.errors.message);
    }
}

const deleteTodo = async (id) => {
    const res = await TodoApi.delete(id);
    if(res.success) {
        getTodos();
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
  getTodos();
});

</script>

<template>
  <div class="min-h-screen flex items-center justify-center bg-gray-50 py-8">
    <div class="w-full max-w-4xl mx-auto bg-white rounded-lg shadow-md overflow-hidden">
      <div class="overflow-x-auto">
        <div class="flex justify-between items-center mt-4 mx-4">
          <router-link to="/todos/create" class="inline-block mb-4 px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">Create New Todo</router-link>
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
          <tr v-for="todo in todos" :key="todo.id">
            <td class="px-4 py-4 text-sm text-slate-900 font-medium">
            {{ todo.title }}
            </td>
            <td class="px-4 py-4 text-sm text-slate-600 font-medium">
            {{ todo.description }}
            </td>
            <td class="px-4 py-4 text-sm">
            <router-link :to="`/todos/edit/${todo.id}`" class="cursor-pointer text-blue-600 font-medium mr-4">Edit</router-link>
            <button class="cursor-pointer text-red-600 font-medium" @click="deleteTodo(todo.id)">Delete</button>
            </td>
          </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</template>
