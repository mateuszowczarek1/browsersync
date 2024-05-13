import {defineStore} from 'pinia'

export const useAuthStore = defineStore('auth', {
    state: () => ({
        user: null
    }),
    actions: {
        setUser(newUser) {
            this.user = newUser;
        },
        clearUser() {
            localStorage.removeItem('user');
            this.user = null;
        },
        getUser() {
            return JSON.parse(localStorage.getItem('user'));
        }
    }
})
