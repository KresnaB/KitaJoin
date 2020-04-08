<template>
    <div>
        <div id="header" class="row">
            <div class="col">
                <h5>Team</h5>
            </div>
            <div class="col">
                <router-link class="float-right" :to="{name: 'create.team'}" tag="button">Create</router-link>
            </div>
        </div>
        <div class="row">
            <div class="col">               
                <card v-for="team in teamsCreated" v-bind:key="team.id" class="shadow-sm">
                    <div class="person-row">
                        <div class="my-auto ml-3">
                            <router-link id="team-name" :to="{name: 'team.details', params: { id: team.id, user_id: team.user_id }}" class="navbar-brand font-weight-bold truncate">
                                {{ team.post_name }}
                            </router-link>
                        </div>
                    </div>
                </card>
                <card v-for="team in teamsJoined" v-bind:key="team.id" class="shadow-sm">
                    <div class="person-row">
                        <div class="my-auto ml-3">
                            <router-link id="team-name" :to="{name: 'team.details', params: { id: team.id, user_id: team.user_id }}" class="navbar-brand font-weight-bold truncate">
                                {{ team.post_name }}
                            </router-link>
                        </div>
                    </div>
                </card>
            </div>
        </div>
    </div>
</template>

<style>
    #header {
        margin-top: 12px;
    }

    h5 {
        color: white;
    }

    #team-name {
        color: black;
    }

    .truncate {
        width: 250px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
</style>

<script>
    import { mapGetters } from 'vuex';
    
    export default {
        mounted() {
            this.$store.dispatch('fetchTeamsCreated', {
                user_id: this.user.id
            }),
            this.$store.dispatch('fetchTeamsJoined', {
                user_id: this.user.id
            })
        },
        computed: mapGetters({
            user: 'auth/user',
            teamsCreated: 'teamsCreated',
            teamsJoined: 'teamsJoined'

        })
    };
</script>