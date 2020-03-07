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
    },
    updatePerson(form) {
        axios.post('/api/update/' + form.id, {image: this.form.image, name: this.form.image, about: this.form.about, telephone: this.form.telephone, interest: this.form.interest})
            .then((res) => {
                this.$store.dispatch('fetchPeople')
            }).catch(err => {
                console.log(err);
            })
    }
}

export default actions