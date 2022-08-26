<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import {useForm} from "@inertiajs/inertia-vue3";
import {reactive} from "vue";
import JetButton from '@/Components/Button.vue';
import JetInput from '@/Components/Input.vue';
import JetInputError from '@/Components/InputError.vue';
import JetLabel from '@/Components/Label.vue';
import {Inertia} from "@inertiajs/inertia";

/*const form = useForm({
    name: '',
    email: '',
    password: ''
});

const submit = () => {
    form.post(route('user.store'), {
        onFinish: () => form.reset('name', 'email', 'password'),
    });
};*/

//Otra forma con reative, en los formularios  va  el nombre del v-model con form ejemplo: v-model="form.name"
defineProps({
    errors: Object
});
let form = reactive({
    name: '',
    email: '',
    password: ''
});

let submit = () => {
    Inertia.post(route('user.store'), form)
}

</script>

<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Create User
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-12">
                    <form @submit.prevent="submit" class="w-1/2 mx-auto space-y-6">
                        <div>
                            <JetLabel for="name" value="Name"/>
                            <JetInput
                                id="name"
                                v-model="form.name"
                                type="text"
                                class="mt-1 block w-full"
                                required
                                autofocus
                                autocomplete="name"
                            />
                            <JetInputError class="mt-2" :message="errors.name"/>
                        </div>
                        <div>
                            <JetLabel for="name" value="Email"/>
                            <JetInput
                                id="email"
                                v-model="form.email"
                                type="email"
                                class="mt-1 block w-full"
                                required
                                autofocus
                                autocomplete="email"
                            />
                            <JetInputError class="mt-2" :message="errors.email"/>
                        </div>
                        <div>
                            <JetLabel for="name" value="Password"/>
                            <JetInput
                                id="password"
                                v-model="form.password"
                                type="password"
                                class="mt-1 block w-full"
                                required
                                autofocus
                                autocomplete="password"
                            />
                            <JetInputError class="mt-2" :message="errors.password"/>
                        </div>
                        <div>
                            <JetButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                Register
                            </JetButton>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
