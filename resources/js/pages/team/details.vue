<template>
    <div class="p-3">
        <card id="general-profile" class="mb-3">
            <div>
                <div id="profile-identity" class="my-auto text-center">
                    <h4>{{ team.post_name }}</h4>
                    <router-link :to="{name: 'update.team', params: {id: team.id}}" tag="button" class="btn btn-dark btn-sm mt-2" v-if="team.user_id === user.id">
                        Edit Team
                    </router-link>
                    <div class="d-flex">
                        <button type="button" class="btn btn-dark d-none d-sm-block mr-2" data-toggle="modal" data-target="#contact-information-modal">
                            Contact information
                        </button>
                    </div>
                </div>
            </div>
        </card>
        <card class="mb-3">
            <div>
                <h6 id="about" class="mb-3 font-weight-light">Team description</h6>
                <p class="mb-0"> {{ team.description }} </p>
                <hr>
                <h6 id="contest-category" class="font-weight-light mb-1">Contest category</h6>
                <p class="mb-0"> {{ team.category }} </p>
            </div>
        </card>
        <card class="mb-3">
            <div class="d-flex">
                <h6 v-if="team.user_id === user.id" id="interest" class="mb-4 font-weight-light mr-auto my-auto">Request</h6>  
                <h6 v-else id="interest" class="mb-4 font-weight-light mr-auto my-auto">Members</h6>  
                <div v-if="team.user_id !== user.id">
                    <input v-if="joinStatus === 'null' && team.user_id !== user.id" id="join-button" class="btn font-weight-bold pr-0" type="button" value="JOIN" @click="join()"/>
                    <input v-else-if="joinStatus.join_status === 0" id="requested-button" class="btn font-weight-bold pr-0" type="button" value="REQUESTED" @click="unjoin(id)"/>
                    <input v-else id="requested-button" class="btn font-weight-bold pr-0" type="button" value="JOINED" @click="unjoin(id)"/>
                </div>
            </div>
            <div v-if="team.user_id !== user.id">
                <div class="d-flex">
                    <img :src="person.image" class="rounded-circle img-responsive my-auto d-block d-sm-none" width="75" height="75">
                    <div id="profile-identity" class="my-auto ml-2">
                        <router-link id="person-name" :to="{ name: 'profile.details', params: {id: person.id}}" class="navbar-brand font-weight-bold">
                            {{ person.name }}
                        </router-link>
                        <p id="person-interest" class="mb-0">{{ person.program}}</p>
                    </div>
                </div>
            </div>
            <div v-if="requests !== 'null'">
                <div v-for="request in requests" v-if="request.join_status !== 0 || team.user_id === user.id" class="d-flex" >
                    <img :src="request.image" class="rounded-circle img-responsive my-auto d-block d-sm-none" width="75" height="75">
                    <div id="profile-identity" class="my-auto ml-2">
                        <router-link id="person-name" :to="{ name: 'profile.details', params: {id: request.user_id}}" class="navbar-brand font-weight-bold">
                            {{ request.name }}
                        </router-link>
<<<<<<< HEAD
                        <div v-if="team.user_id === user.id" class="d-flex">
                            <button type="button" class="btn btn-dark btn-sm mr-2">Confirm</button>
                            <router-link :to="{name: ''}" tag="button" class="btn btn-secondary btn-sm">Delete</router-link>
                        </div>
                        <p v-else id="person-interest" class="mb-0">{{ person.program}}</p>
=======
                        <button v-if="request.join_status === 0" type="button" class="btn btn-dark btn-sm btn-block mr-2" @click="confirm(request.user_id)">Confirm</button>
                        <button v-else type="button" class="btn btn-secondary btn-sm btn-block mr-2" @click="deleteRequest(request.user_id)">Delete</button>                        
>>>>>>> feat/update-team
                    </div>
                </div>
            </div>
            <p v-else-if="team.user_id === user.id" id="no-request-paragraph" class="mb-0">No Requests</p>
        </card>
        <card v-if="team.user_id === user.id" class="mb-3">
            <h6 id="dangerous-area" class="mb-4 font-weight-light">Dangerous area</h6>
            <input class="btn btn-secondary btn-lg btn-block text-left font-weight-bold" type="button" value="Delete team" @click="deleteTeam()" />
        </card>
    </div>
</template>

<style scoped>
    h4, .telephone{
        color: black;
    }

    p {
        font-size: 2vh;
    }

    #no-request-paragraph {
        font-size: 4vw;
    }
    
    h6, p, #interest, #about{
        color: rgb(136, 148, 153);
    }

    h4 {
        font-size: 5.5vw;
    }

    h6 {
        font-size: 3.5vw;
    }

    #person-name {
        color: black;
    }

    h5, #person-name {
        font-size: 4.5vw;
    }

    #contest-category {
        font-size: 3vw;
    }

    #general-profile {
        margin-top: 2vh;
    }

    button {
        font-size: 4vw;
    }

    #join-button, #requested-button {
        -webkit-box-shadow: none!important;
        box-shadow: none!important;
    }

    @media (min-width: 768px) {
        #general-profile {
            margin-top: 24vh;
            margin-bottom: 24vh;
        }

        h4 {
            font-size: 4.5vw;
        }

        h6 {
            font-size: 3vw;
        }

        #profile-identity {
            margin-left: 3vw;
        }

        #study-program {
            margin-bottom: 24px;
        }
    }

    .card {
        padding: 12px;
        border-radius: 12px;
    }

    li {
        color: white;
        padding: 8px;
        border-radius: 14px;
    }

    @media (min-width: 1024px) {
        #contact-information, #telephone {
            font-size: 2vw;
        }
    }

    @media (max-width: 414px) {
        #interest, #contact, #about, #dangerous-area {
            font-size: 5vw;
        }

        #user-study-program {
            margin-bottom: 2vh;
        }
    }
</style>

<script>
    import Form from 'vform'
    import { mapGetters } from 'vuex'; 
    import axios from 'axios'

    export default {
        
        data: () => ({
            form: new Form({}),
            id: {
                user_id: null,
                post_id: null
            },
            requestId: {
                user_id: null,
                post_id: null
            }
        }),

        mounted() {
            this.id.user_id = this.user.id,
            this.id.post_id = this.$route.params.id,
            this.$store.dispatch('fetchTeam', {
                id: this.$route.params.id
            }),
            this.$store.dispatch('fetchPerson', {
                id: this.$route.params.user_id
            }),
            this.$store.dispatch('fetchRequests', {
                post_id: this.$route.params.id
            }),
            this.$store.dispatch('fetchUser'),
            this.$store.dispatch('fetchJoinStatus', this.id)
        },

        computed: mapGetters({
            user: 'auth/user',
            team: 'team',
            requests: 'requests',
            person : 'person',
            joinStatus: 'joinStatus'
        }),

        methods: {
            deleteTeam: function() {
                let currentObj = this;

                axios.delete('/api/post/delete/' + this.$route.params.id).then(function (response) {
                    currentObj.success = response.data.success;
                }).catch(function (error) {
                    currentObj.output = error;
                });

                this.$router.push({ name: 'team' });
            },

            join: function() {
                let currentObj = this;

                axios.post('/api/follow/' + this.team.id)
                .then(function (response) {
                    currentObj.success = response.data.success;
                }).catch(function (error) {
                    currentObj.output = error;
                });

                this.$router.go();
            },

            unjoin: function(id) {
                let currentObj = this;

                axios.delete('/api/joinstatus/delete/' + this.user.id + '/' + this.$route.params.id)
                .then(function (response) {
                    currentObj.success = response.data.success;
                }).catch(function (error) {
                    currentObj.output = error;
                });

                this.$router.go();
            },

            confirm: function(user_id) {
                let currentObj = this;

                this.requestId.user_id = user_id;
                this.requestId.post_id = this.$route.params.id;

                axios.post('/api/request/accept', this.requestId)
                .then(function (response) {
                    currentObj.success = response.data.success;
                }).catch(function (error) {
                    currentObj.output = error;
                });

                this.$router.go();
            },

            deleteRequest: function(user_id) {
                let currentObj = this;

                this.requestId.user_id = user_id;
                this.requestId.post_id = this.$route.params.id;

                axios.post('/api/request/delete', this.requestId)
                .then(function (response) {
                    currentObj.success = response.data.success;
                }).catch(function (error) {
                    currentObj.output = error;
                });

                this.$router.go();
            }
        }
    }
</script>