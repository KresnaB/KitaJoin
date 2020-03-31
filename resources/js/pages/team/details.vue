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
            <div>
                <h6 id="interest" class="mb-4 font-weight-light">Request</h6>
                <div class="d-flex">
                    <img src="https://www.gravatar.com/avatar/'.md5(strtolower($this->email)).'.jpg?s=200&d=mm" class="rounded-circle img-responsive my-auto d-block d-sm-none" width="75" height="75">
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

    h6, p, #interest, #about{
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
        #interest, #contact, #about {
            font-size: 5vw;
        }

        #user-study-program {
            margin-bottom: 2vh;
        }
    }
</style>

<script>
    import { mapGetters } from 'vuex'; 

    export default {
        mounted() {
            this.$store.dispatch('fetchTeam', {
                id: this.$route.params.id
            })
        },
        computed: {
            ...mapGetters([
                'team'
            ])
        }
    }
</script>