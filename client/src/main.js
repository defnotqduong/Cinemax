import { createApp } from 'vue'
import { createPinia } from 'pinia'
import piniaPluginPersistedstate from 'pinia-plugin-persistedstate'
import './style.css'
import App from './App.vue'
import store from './stores'
import router from './routes'

import VueAwesomeSwiper from 'vue-awesome-swiper'

import SwiperClass, { Pagination, Navigation, EffectFade, Controller, Thumbs, FreeMode } from 'Swiper'
import 'swiper/css'
import 'swiper/css/pagination'
import 'swiper/css/navigation'
import 'swiper/css/effect-fade'
import 'swiper/css/thumbs'
import 'swiper/css/free-mode'

SwiperClass.use([Pagination, Navigation, EffectFade, Controller, Thumbs, FreeMode])

const pinia = createPinia()
pinia.use(piniaPluginPersistedstate)

const app = createApp(App)

app.use(pinia)
app.use(router)
app.use(store)
app.use(VueAwesomeSwiper)

app.mount('#app')
