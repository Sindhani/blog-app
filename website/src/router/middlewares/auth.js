import {useAuthStore} from "stores/useAuthStore.js";

const except = ['blogs.index', 'blogs.show', 'home']
export default async (to, from, next) => {
    const authStore = useAuthStore()
    if (except.indexOf(to.name) === -1 && !authStore.isAuthenticated) {
        await authStore.fetchMe()
            .then(() => {
                next()
            })
            .catch(() => {
            })
            .finally(() => {
            })
    } else {
        next()
    }
}


