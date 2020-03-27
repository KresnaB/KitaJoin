let mutations = {
    FETCH_PEOPLE(state, people) {
        return state.people = people
    },
    FETCH_TEAMS(state, teams) {
        return state.teams = teams
    },
    FETCH_PERSON(state, person) {
        return state.person = person
    },
    FETCH_USER(state, user) {
        return state.user = user
    }
}

export default mutations