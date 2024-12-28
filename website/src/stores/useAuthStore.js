import {defineStore} from 'pinia';
import {Loading, SessionStorage} from "quasar";
import {localAxios} from 'boot/axios.js';
import {route} from "boot/ziggy.js";

const key = 'auth-token'
export const useAuthStore = defineStore('auth', {
    state: () => ({
        token: SessionStorage.hasItem(key) ? SessionStorage.getItem(key) : null,
        user: null,
        error: null
    }),
    getters: {
        isAuthenticated: (state) => !!state.token,
    },
    actions: {
        async setToken(token) {
            this.token = token
            sessionStorage.setItem(key, this.token);
            await this.fetchMe();
        },
        async fetchMe() {
            try {
                if (!this.token) {
                    throw new Error('Token not available');
                }
                const response = await localAxios.get('/me');
                this.user = response.data;
            } catch (error) {
                console.error('Failed to fetch user details:', error);
                await this.logout();
                throw error;
            }
        },
        async logout() {
            Loading.show()
            await localAxios.post('/logout')
            this.token = null;
            this.user = null;
            SessionStorage.remove(key);
            Loading.hide()
        },
        async sendOtp(email) {
            try {
                Loading.show()
                return await localAxios.post(route('auth.send-otp'), {email: email})
            } catch (error) {
                console.error('Failed to fetch user details:', error);
                this.error = error.response.data.error
                throw error;
            } finally {
                Loading.hide()

            }

        },

    },
});