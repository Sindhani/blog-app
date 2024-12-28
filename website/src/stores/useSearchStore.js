// src/stores/search.js
import {defineStore} from 'pinia';
import {localAxios as axios} from 'boot/axios';
import {route} from "boot/ziggy.js"; // Import the pre-configured axios

export const useSearchStore = defineStore('search', {
    state: () => ({
        query: '',
        results: [],
        loading: false,
        error: null,
    }),
    actions: {
        async performSearch() {
            if (!this.query) {
                this.results = [];
                return;
            }
            this.loading = true;
            this.error = null;

            try {
                const response = await axios.get(route('blogs.search'), {
                    params: {query: this.query},
                });
                this.results = response.data;
            } catch (err) {
                this.error = 'Failed to fetch search results';
                console.error(err);
            } finally {
                this.loading = false;
            }
        },
    },
});