import {boot} from 'quasar/wrappers'
import {route as ziggyRoute, ZiggyVue} from "ziggy-js"

let route = null
export default boot(async ({app}) => {
    const response = await fetch(process.env.API_URL + '/ziggy')
    const ziggyConfig = await response.json()
    app.use(ZiggyVue, ziggyConfig)
    route = (name, params) => ziggyRoute(name, params, undefined, ziggyConfig)
})
export {route}
