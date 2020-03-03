import axios from 'axios'

let actions = {
    fetchPeople({commit}) {
        axios.get('/api/profiles')
            .then(res => {
                commit('FETCH_PEOPLE', res.data)
            }).catch(err => {
                console.log(err)
            })
    },

    fetchPerson({commit}) {
        axios.get('/api/profiles/${to.params.id}')
            .then(res => {
                commit('FETCH_PERSON', res.data)
            }).catch(err => {
                console.log(err)
            })
    }
}

export default actions