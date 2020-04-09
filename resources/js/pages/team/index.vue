<template>
    <div class="mt-4">
        <div id="header" class="row">
            <div class="col my-auto">
                <h5 class="mb-0">Teams</h5>
            </div>
            <div class="col">
                <router-link id="create-button" class="text-white float-right p-0" :to="{name: 'create.team'}" tag="button">
                    <fa icon="plus"></fa>
                </router-link>
            </div>
        </div>
        <div class="row">
            <div class="col mt-2">               
                <card v-for="team in teamsCreated" v-bind:key="team.id" class="shadow-sm mb-4">
                    <div class="person-row">
                        <div class="my-auto ml-3">
                            <router-link id="team-name" :to="{name: 'team.details', params: { id: team.id, user_id: team.user_id }}" class="navbar-brand font-weight-bold truncate">
                                {{ team.post_name }}
                            </router-link>
                        </div>
                    </div>
                </card>
                <card v-for="team in teamsJoined" v-bind:key="team.id" class="shadow-sm mb-4">
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

    #create-button {
        background-color: black;
        border-color: black;
        font-size: 6vw;
    }

    #create-button:focus, #create-button:active {
        outline: none !important;
        box-shadow: none;
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