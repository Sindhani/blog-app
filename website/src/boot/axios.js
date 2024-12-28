import axios from 'axios'
import objectToFormData from 'src/utils/objectToFormData'
import {configure} from "quasar/wrappers"
import {useAuthStore} from "stores/useAuthStore.js";
import Form from "vform"

let localAxios = null
const instance = axios.create({
    baseURL: process.env.API_URL,
})
export default configure(async ({app, router}) => {
    const authStore = useAuthStore()
    instance.interceptors.request.use(request => {
        request.transformRequest = (data) => {
            if (request.method === 'patch') {
                data = {...data, _method: 'patch'}
                request.method = 'post'
            }
            return objectToFormData(data)

        }
        const token = authStore.token
        if (token) {
            request.headers.Authorization = `Bearer ${token}`
        }
        instance.defaults.headers.common['Content-Type'] = undefined
        instance.defaults.headers.common['Accept'] = 'application/json'

        return request
    })

    instance.interceptors.response.use(
        response => {
            return Promise.resolve(response)
        },
        error => {
            const message = error.response?.data?.message
            const duration = process.env.DEV ? 20000 : 3000
            switch (error.response?.status) {
                case 422:
                    setTimeout(() => {
                        let errorContainer = document.getElementsByClassName('q-field--error')
                        if (errorContainer.length)
                            errorContainer[0].scrollIntoView({behavior: "smooth", block: "center", inline: "nearest"})
                    }, 200)
                    break

                case 404:
                    break

                case 401:
                    authStore.logout()
                    router.push('/')
                    break
                case 500:
                    app.config.globalProperties.$toasted.error(message, {duration})
                    break


            }
            return Promise.reject(error)
        })
    app.config.globalProperties.$axios = localAxios = instance
    Form.axios = instance

})
export {localAxios}





