let mutations = {
    FETCH_PEOPLE(state, people) {
        return state.people = people
    },
<<<<<<< HEAD
    FETCH_TEAMS(state, teams) {
        return state.teams = teams
=======
    FETCH_PERSON(state, person) {
        return state.person = person
    },
    FETCH_USER(state, user) {
        return state.user = user
>>>>>>> e130a96a5b75355cf3540678bc353bf90b0c552a
    }
}

export default mutations