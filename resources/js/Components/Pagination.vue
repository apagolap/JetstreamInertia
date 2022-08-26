<script setup>
import { InertiaLink} from '@inertiajs/inertia-vue3';

const props = defineProps({
    links: Array,
});
</script>

<template>
    <div v-if="links.length > 3">
        <div class="flex flex-wrap -mb-1">
            <template v-for="link in links">
                <div v-if="link.url === null" class="mr-1 mb-1 px-4 py-3 text-sm leading-4 text-gray-400 border rounded"
                     v-html="link.label"/>
                <inertia-link v-else
                              class="mr-1 mb-1 px-4 py-3 text-sm leading-4 text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 border rounded  focus:border-indigo-500 focus:text-indigo-500"
                              :class="{ 'text-blue-600 bg-blue-50 border border-blue-300 hover:bg-blue-100 hover:text-blue-700': link.active }" :href="link.url" v-html="link.label"/>
            </template>
        </div>
    </div>
</template>

