import Vue from 'vue'
import Vuex from 'vuex'
import axios from 'axios'

Vue.use(Vuex)
axios.defaults.baseURL = 'http://proyekperangkatlunak/api'
export const store = new Vuex.store({
    state: {
        token: localStorage.getItem('access_token') || null,
    },
    mutations: {
        setToken(state, token) {
            state.token = token
        },
        destroyToken(state) {
            state.token = null
        },
    },
    actions: {
        register(context, data) {
            return new Promise((resolve, reject) => {
                axios.post('/register', {
                    name: data.name,
                    email: data.email,
                    password: data.password
                }).then(response => {
                    resolve(response)
                }).catch(error => {
                    reject(error)
                })
            })
        },
    },
})