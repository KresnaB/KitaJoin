import axios from 'axios'

let actions = {
    fetchPeople({commit}) {
        axios.get('/api/profiles')
            .then(res => {
                commit('FETCH_PEOPLE', res.data)
            }).catch(err => {
<<<<<<< HEAD
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
=======
                console.log(err)
            })
    },
    fetchPerson({commit}, data) {
        axios.get('/api/profiles/' + data.id)
            .then((res) => {
                commit('FETCH_PERSON', res.data)
            }).catch(err => {
                console.log(err)
            })
    },
    fetchUser({commit}) {
        axios.get('/api/user')
            .then((res) => {
                commit('FETCH_USER', res.data)
            }).catch(err => {
                console.log(err)
            })
>>>>>>> e130a96a5b75355cf3540678bc353bf90b0c552a
    }

}

export default actions