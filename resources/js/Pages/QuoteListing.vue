<template>
    <Head title="Dashboard" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Dashboard
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <Link :href="route('quotes.index')" v-if="route().current() == 'quotes.index'" class="inline-flex items-center px-4 py-2 bg-blue-500 border  rounded border-transparent font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray transition ease-in-out duration-150 mb-5">Refresh</Link>
                        <Quotes :quotes="quotes"/>
                    </div>
                </div>
            </div>
        </div>
    </BreezeAuthenticatedLayout>

</template>

<script>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import { Head, Link } from '@inertiajs/inertia-vue3';
import Quotes from "@/Components/Quotes.vue";

export default {
    name: "QuoteListing",
    components: {
        Quotes, BreezeAuthenticatedLayout, Head, Link
    },
    props: ['quotes']
}
</script>

<style scoped>

</style>
