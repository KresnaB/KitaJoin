let getters = {
    people: state => {
        return state.people
    },
    teams: state => {
        return state.teams
    },
    team: state => {
        return state.team
    },
    person: state => {
        return state.person
    },
    user: state => {
        return state.user
    },
    form: state => {
        return state.form
    },
    requests: state => {
        return state.requests
    }
}

export default getters