import middleware from 'src/router/middlewares/auth'
import {configure} from "quasar/wrappers"
import {useAuthStore} from "stores/useAuthStore.js";
import {SessionStorage} from "quasar";

export default configure(async ({router}) => {
    const store = useAuthStore()
    if (SessionStorage.getItem('auth-token') && !store.user) {
        store.token = SessionStorage.getItem('auth-token')
        await store.fetchMe()
    }
    router.beforeEach(middleware)
})





