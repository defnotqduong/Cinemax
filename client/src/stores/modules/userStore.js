import { defineStore } from 'pinia'
import { USER_STORE } from './../../configs/storeTypes'
import { removeUserStoreStore } from './../../configs/connectServer'

export const useUserStore = defineStore(USER_STORE, {
    state: () => ({
        user: {}
    }),
    actions: {
        logout() {
            removeUserStoreStore()
            this.user = {}
        }
    }
})

export default {
    useUserStore
}
