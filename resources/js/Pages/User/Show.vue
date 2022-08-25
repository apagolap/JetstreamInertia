<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import JetLabel from '@/Components/Label.vue';

const props = defineProps({
    userSelect: Object,
});
</script>

<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Show User
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-12">
                    <div class="space-y-6">
                        <JetLabel for="name" :value="'Name: '+userSelect.name"/>
                        <JetLabel for="name" :value="'Email: '+userSelect.email"/>
                        <div class="flex items-center space-x-8">
                            <JetLabel for="name" value="Photo"/>
                            <img class="h-8 w-8 rounded-full object-cover" :src="userSelect.profile_photo_url"
                                 :alt="userSelect.name">
                        </div>
                        <pre>
                            {{ userSelect }}
                        </pre>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
