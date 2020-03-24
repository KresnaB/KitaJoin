let mutations = {
    FETCH_PEOPLE(state, people) {
        return state.people = people
    },
    FETCH_TEAMS(state, teams) {
        return state.teams = teams
    }
}

export default mutations