<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import {Link, useForm} from '@inertiajs/inertia-vue3';
import {ref, watch} from "vue";
import {Inertia} from '@inertiajs/inertia';
import JetConfirmationModal from '@/Components/ConfirmationModal.vue';
import JetInput from '@/Components/Input.vue';
import JetButton from '@/Components/Button.vue';
import Pagination from '@/Components/Pagination.vue';
import Paginator from '@/Components/Paginator.vue';
import {debounce, throttle} from "lodash"; // Para búsques con tiempo

const props = defineProps({
    users: Object,
    modalOpen: false,
    userSelect: Object,
    filters: Object,
    time: String,
});

/*const form = useForm({
    search: props.search
});*/

/*const submit = () => {
    Inertia.get(route('user.index', {'search': form.search}));
};*/

const deleteUser = () => {
    Inertia.delete(route('user.destroy', {'user': props.userSelect}));
};

/*# Other form seach data*/
let search = ref(props.filters.search);

/*watch(search, throttle(function (value) {
    Inertia.get('/user', {search: value}, {
        preserveState: true,
        replace: true
    })
}, 300));*/

watch(search, debounce(function (value) {
    console.log('Send after finish write: ')
    Inertia.get('/user', {search: value}, {
        preserveState: true,
        replace: true
    })
}, 300));
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
                        <JetInput
                            v-model="search"
                            type="text"
                            class="mt-1 block w-1/2"
                            autofocus
                            placeholder="Buscar por Nombre o Email ..."
                            autocomplete="search"
                        />
                    </div>
                    <div class="w-full">
                        <div class="bg-white shadow-md rounded my-6">
                            <table class="w-full table-auto">
                                <thead>
                                <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                                    <th class="py-3 px-6 text-left">Id</th>
                                    <th class="py-3 px-6 text-left">Name</th>
                                    <th class="py-3 px-6 text-center">Email</th>
                                    <th class="py-3 px-6 text-center">Actions</th>
                                </tr>
                                </thead>
                                <tbody class="text-gray-600 text-sm font-light">
                                <tr v-for="user in users.data" :key="user.id"
                                    class="border-b border-gray-200 hover:bg-gray-100">
                                    <td class="py-3 px-6 text-left">
                                        {{ user.id }}
                                    </td>
                                    <td class="py-3 px-6 text-left">
                                        <div class="flex items-center">
                                            <div class="mr-2">
                                                <img class="h-8 w-8 rounded-full object-cover"
                                                     :src="user.profile_photo_url"
                                                     :alt="user.name">
                                            </div>
                                            <span class="font-medium">{{ user.name }}</span>
                                        </div>
                                    </td>
                                    <td class="py-3 px-6 text-left">
                                        {{ user.email }}
                                    </td>
                                    <td class="py-3 px-6 text-center">
                                        <div class="flex item-center justify-center">
                                            <Link :href="route('user.show',{user:user})"
                                                  class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                     stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                          stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                          stroke-width="2"
                                                          d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                                </svg>
                                            </Link>
                                            <Link :href="route('user.edit',{user:user})"
                                                  :data="{infoIndex:'Hola Soy un dato desde index.'}"
                                                  class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                     stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                          stroke-width="2"
                                                          d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                                                </svg>
                                            </Link>
                                            <Button @click="modalOpen=true;userSelect=user"
                                                    class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                     stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                          stroke-width="2"
                                                          d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                </svg>
                                            </Button>
                                        </div>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
<!--                        <pagination class="mt-6" :links="users.links"/>-->
                        <paginator :paginator="users"/>
                    </div>
                </div>
            </div>
        </div>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mb-6">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-12">
                <p>The current time es {{ time }}.</p>
                <Link :href="route('user.index')" class="text-blue-500" preserve-scroll>Refresh</Link>
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

