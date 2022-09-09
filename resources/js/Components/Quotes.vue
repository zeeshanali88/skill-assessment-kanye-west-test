<template>
    <div @click="hideTopBanner(true)" v-if="message_info_obj.message" :class="`bg-${message_info_obj.color}-400 py-3 px-3 mb-4 border-l-4 border-black text-black p4 cursor-pointer`" role="alert">
        <p>{{message_info_obj.message}}</p>
    </div>

    <div v-if="quotes_data.length == 0">No Data Exists</div>
    <div class="grid lg:grid-cols-4 ">
        <div class="mb-3 mr-3 p-4 text-gray-800 bg-white rounded-lg shadow" v-for="quote in quotes_data" :key="quote.id">
            <div class="favorite_button flex mb-5 items-center flex-col">
                <a title="Add to favorites" @click="addToFavourite(quote.id)" v-if="can_add_to_favourite"><span class="items-center inline-flex items-center px-2 py-0 bg-green-400 border border-transparent rounded-md font-semibold text-lg text-black uppercase tracking-widest active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray transition ease-in-out duration-150 cursor-pointer">+</span></a>
                <a @click="removeFromFavorites(quote.id)" v-if="can_delete"><span class="inline-flex items-center px-2 py-0 bg-red-400 border border-transparent rounded-md font-semibold text-xl text-black uppercase tracking-widest active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray transition ease-in-out duration-150 cursor-pointer">-</span></a>
            </div>
            <div class="mb-2">
                <div class="h-3 text-3xl text-left text-gray-600">“</div>
                <p class="px-4 text-sm text-center text-gray-600">
                    {{quote.quote}}
                </p>
                <div class="h-3 text-3xl text-right text-gray-600">”</div>

            </div>
        </div>
    </div>
</template>

<script>
import { Link } from '@inertiajs/inertia-vue3';
import axios from 'axios'

export default {
    name: "Quotes",
    props: ['quotes'],
    components: {
        Link
    },
    data() {
        return {
            quotes_data: [],
            current_route: null,
            can_delete: route().current() == 'favourite.quotes',
            can_add_to_favourite: route().current() == 'quotes.index',
           message_info_obj: {
                 message: '', color: 'green'
           }
        }
    },
    mounted() {
        this.quotes_data = this.quotes;
    },
    methods: {
        addToFavourite(quote_id) {
            let self = this;
            axios.get(route('add.quote.to_favourite', quote_id)).then((successResponse) => {
               this.message_info_obj = successResponse.data
                this.hideTopBanner()
            })
        },
        removeFromFavorites(quote_id) {
            let self = this;
            axios.get(route('favourite.quote.remove', quote_id)).then((successResponse) => {
                const response_data = successResponse.data
               this.message_info_obj.message = response_data.message
               this.message_info_obj.color = response_data.color
                this.quotes_data = response_data.quotes
                this.hideTopBanner()
            })
        },
        hideTopBanner(hide_immediate = false) {
            const default_obj = { message: '', color: 'green'}
            if(hide_immediate) {
                this.message_info_obj = default_obj
            } else {
                setTimeout(() => {
                    this.message_info_obj = default_obj
                }, 5000)
            }
        }
    }

}
</script>

<style scoped>

</style>
