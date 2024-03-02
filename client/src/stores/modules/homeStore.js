import { defineStore } from 'pinia'
import { HOME_STORE } from './../../configs/storeTypes'

export const useHomeStore = defineStore(HOME_STORE, {
    state: () => ({
        categories: [],
        genres: [],
        countries: [],
        seriesMovies: [],
        singleMovies: [],
        cartoonMovies: [],
        suggetMovies: [],
        newMovies: []
    }),
    actions: {}
})

export default {
    useHomeStore
}
