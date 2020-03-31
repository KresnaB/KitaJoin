<template>
    <div class="p-3">
        <card id="general-profile" class="mb-3">
            <div>
                <div id="profile-identity" class="my-auto">
                    <h4 class="text-center mb-1">{{ team.post_name }}</h4>
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
                <button class="btn font-weight-bold">JOIN</button>
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
                <div class="d-flex" v-for="request in requests">
                    <img :src="request.image" class="rounded-circle img-responsive my-auto d-block d-sm-none" width="75" height="75">
                    <div id="profile-identity" class="my-auto ml-2">
                        <h5>Person Name</h5>
                        <div class="d-flex">
                            <button type="button" class="btn btn-dark btn-sm mr-2" data-toggle="modal" data-target="#contact-information-modal">
                                Confirm
                            </button>
                            <router-link :to="{name: ''}" tag="button" class="btn btn-secondary btn-sm">
                                Delete
                            </router-link>
                        </div>
                    </div>
                </div>
            </div>
            <p v-else-if="team.user_id === user.id" id="no-request-paragraph" class="mb-0">No Requests</p>
        </card>
        <card class="mb-3">
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
    
    h6, p, #interest, #about, button{
        color: rgb(136, 148, 153);
    }

    h4 {
        font-size: 5.5vw;
    }

    h6 {
        font-size: 3.5vw;
    }

    h5 {
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
            form: new Form({})
        }),

        mounted() {
            this.$store.dispatch('fetchTeam', {
                id: this.$route.params.id
            }),
            this.$store.dispatch('fetchPerson', {
                id: this.$route.params.user_id
            }),
            this.$store.dispatch('fetchRequests', {
                post_id: this.$route.params.id
            }),
            this.$store.dispatch('fetchUser')
        },

        computed: {
            ...mapGetters([
                'team',
                'requests',
                'user',
                'person'
            ])
        },

        methods: {
            deleteTeam: function() {
                let currentObj = this;

                axios.delete('/api/post/delete/' + this.$route.params.id).then(function (response) {
                    currentObj.success = response.data.success;
                }).catch(function (error) {
                    currentObj.output = error;
                });

                this.$router.push({ name: 'team' });
            }
        }
    }
</script>