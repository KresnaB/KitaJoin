<template>
    <div class="p-3">
        <card id="general-profile" class="mb-3">
            <div>
                <div id="profile-identity" class="my-auto">
                    <h4 class="text-center mb-1">Contest Name</h4>
                    <p class="text-center mb-0">Posted x minute ago</p>
                    <div class="d-flex">
                        <button type="button" class="btn btn-dark d-none d-sm-block mr-2" data-toggle="modal" data-target="#contact-information-modal">
                            Contact information
                        </button>
                        <router-link :to="{name: 'settings.profile', params: {id: person.id}}" tag="button" class="btn btn-dark btn-sm" v-if="user.id === person.id">
                            Edit Profile
                        </router-link>
                    </div>
                </div>
                <div id="contact-information-modal" class="modal" tabindex="-1" role="dialog">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title font-weight-light">{{ person.name }}</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <h6 id="contact-information" class="font-weight-light mb-4">Contact Information</h6>
                                <div class="d-flex">
                                    <fa icon="address-book" class="mr-4 fa-2x my-auto"/>
                                    <div>
                                        <h6 id="telephone" class="font-weight-bold mb-0 telephone">Telephone</h6>
                                        <p id="telephone-number" class="mb-0">{{ person.contact }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </card>
        <card class="mb-3" v-if="person.bio !== null">
            <div>
                <h6 id="about" class="mb-3 font-weight-light">Team description</h6>
                <p class="mb-0"> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean non metus arcu. Aenean malesuada tincidunt dolor quis laoreet. Suspendisse a mattis libero. Phasellus non luctus mauris. Pellentesque eleifend, ante sit amet eleifend consequat, velit sapien consequat augue, et tempus est velit id nulla. Mauris ante eros, interdum vel iaculis id, pulvinar eu nulla. Quisque vel pellentesque urna. Morbi ac sagittis diam. Sed sed imperdiet leo. </p>
                <hr>
                <h6 id="contest-category" class="font-weight-light mb-1">Contest category</h6>
                <p class="mb-0">Lorem</p>
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
                            <router-link :to="{name: 'settings.profile', params: {id: person.id}}" tag="button" class="btn btn-secondary btn-sm">
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
        this.$store.dispatch('fetchPerson', {
            id: this.$route.params.id
        }),
        this.$store.dispatch('fetchUser')
    },
    computed: {
        ...mapGetters([
            'person',
            'user'
        ])
    }
}
</script>