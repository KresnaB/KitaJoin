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
    fetchTeams({commit}) {
        axios.get('/api/posts')
            .then(res => {
                commit('FETCH_TEAMS', res.data)
            }).catch(err => {
            console.log(err)
        })
    }

}

export default actions