<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import {useForm} from "@inertiajs/inertia-vue3";
import JetButton from '@/Components/Button.vue';
import JetInput from '@/Components/Input.vue';
import JetInputError from '@/Components/InputError.vue';
import JetLabel from '@/Components/Label.vue';

const props = defineProps({
    userSelect: Object,
});

const form = useForm({
    name: props.userSelect.name,
    email: props.userSelect.email,
    password: props.userSelect.password
});

const submit = () => {
    form.put(route('user.update', {'user': props.userSelect}), {
        onFinish: () => form.reset('name', 'email', 'password'),
    });
};
</script>

<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Edit User
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-12">
                    {{ userSelect.name }}
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
                            <JetInputError class="mt-2" :message="form.errors.name"/>
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
                            <JetInputError class="mt-2" :message="form.errors.email"/>
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
                            <JetInputError class="mt-2" :message="form.errors.password"/>
                        </div>
                        <div>
                            <JetButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                Actualizar
                            </JetButton>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
