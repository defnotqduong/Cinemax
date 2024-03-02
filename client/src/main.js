import { createApp } from 'vue'
import { createPinia } from 'pinia'
import piniaPluginPersistedstate from 'pinia-plugin-persistedstate'
import './style.css'
import App from './App.vue'
import store from './stores'
import router from './routes'

import SwiperClass, { Pagination } from 'Swiper'
import VueAwesomeSwiper from 'vue-awesome-swiper'
import 'swiper/css'
import 'swiper/css/pagination'

SwiperClass.use([Pagination])

const pinia = createPinia()
pinia.use(piniaPluginPersistedstate)

const app = createApp(App)

app.use(pinia)
app.use(router)
app.use(store)
app.use(VueAwesomeSwiper)

app.mount('#app')
