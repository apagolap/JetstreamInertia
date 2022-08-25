<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import {Link, useForm} from '@inertiajs/inertia-vue3';
import {Inertia} from '@inertiajs/inertia';
import JetConfirmationModal from '@/Components/ConfirmationModal.vue';
import JetInput from '@/Components/Input.vue';
import JetButton from '@/Components/Button.vue';

const props = defineProps({
    users: Array,
    modalOpen: false,
    userSelect: Object,
    search: String,
});

const form = useForm({
    search: props.search
});

const submit = () => {
    Inertia.get(route('user.index', {'search': form.search}));
};

const deleteUser = () => {
    Inertia.delete(route('user.destroy', {'user': props.userSelect}));
};
</script>

<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                List Users
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-12">
                    <!--                    <pre>-->
                    <!--                        {{ $page }}-->
                    <!--                    </pre>-->
                    <div class="mb-4">
                        <Link :href="route('user.create')"
                              class="inline-block  bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded cursor-pointer">
                            <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                 class="w-6 h-6 float-left mr-2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v18m9-9H3"/>
                            </svg>
                            Crear Usuario
                        </Link>
                    </div>

                    <div class="mb-4">
                        <form @submit.prevent="submit" class="flex space-x-8">
                            <JetInput
                                id="name"
                                v-model="form.search"
                                type="text"
                                class="mt-1 block w-full"
                                autofocus
                                placeholder="Buscar por Nombre o Email ..."
                                autocomplete="search"
                            />
                            <JetButton type="submit" :class="{ 'opacity-25': form.processing }"
                                       :disabled="form.processing">
                                Buscar
                            </JetButton>
                        </form>
                    </div>

                    <table class="table-auto w-full">
                        <thead>
                        <th class="p-3 border">Id</th>
                        <th class="p-3 border">Nombre</th>
                        <th class="p-3 border">Email</th>
                        <th class="p-3 border">Acciones</th>
                        </thead>
                        <tbody>
                        <tr v-for="user in users" :key="user.id">
                            <td class="p-3 border">{{ user.id }}</td>
                            <td class="p-3 border">{{ user.name }}</td>
                            <td class="p-3 border">{{ user.email }}</td>
                            <td class="p-3 border text-center space-x-4">
                                <Link :href="route('user.show',{user:user})"
                                      class="inline-block bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded cursor-pointer">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                         stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    </svg>
                                </Link>
                                <Link :href="route('user.edit',{user:user})"
                                      class="inline-block bg-orange-500 hover:bg-orange-700 text-white font-bold py-2 px-4 rounded cursor-pointer">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                         stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125"/>
                                    </svg>
                                </Link>
                                <button @click="modalOpen=true;userSelect=user"
                                        class="align-top bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded cursor-pointer">
                                    <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                         class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"/>
                                    </svg>
                                </button>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <jet-confirmation-modal :show="modalOpen">
            <template v-slot:title>
                <h2>Eliminar Usuario</h2>
            </template>
            <template v-slot:content>
                <p v-if="userSelect">¿Seguro que quieres eliminar el usuario: {{ userSelect.name }} ?</p>
            </template>
            <template v-slot:footer>
                <div class="space-x-8">
                    <jet-button class="bg-red-500 hover:bg-red-700" @click="deleteUser();modalOpen=false">Eliminar
                    </jet-button>
                    <jet-button class="bg-gray-500 hover:bg-gray-700" @click="modalOpen=false">Cerrar</jet-button>
                </div>
            </template>
        </jet-confirmation-modal>
    </AppLayout>
</template>


