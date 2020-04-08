<template>
    <div class="p-3">
        <card id="general-profile" class="mb-3">
            <div class="d-flex">
                <img :src="person.image" class="rounded-circle img-responsive my-auto d-block d-sm-none" width="75" height="75">
                <img :src="person.image" class="rounded-circle img-responsive my-auto d-none d-sm-block" width="auto" height="130">
                <div id="profile-identity" class="my-auto">
                    <h4>{{ person.name }}</h4>
                    <div v-if="person.program !== 'Empty'">
                        <h6 id="user-study-program" v-if="user.id === person.id">{{ person.program }}</h6>
                        <h6 id="study-program" v-else>{{ person.program }}</h6>
                    </div>
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
            <div v-if="person.contact !== 'Empty' && user.id !== person.id" class="text-center mt-4">
                <a :href="'https://wa.me/' + person.contact" class="btn fa-whatsapp text-white font-weight-bold">
                    <fa :icon="['fab', 'whatsapp']" />
                    WhatsApp
                </a>
            </div>
        </card>
        <card class="mb-3" v-if="person.bio !== null">
            <div>
                <h6 id="about" class="mb-3 font-weight-light">About</h6>
                <p class="mb-0">{{ person.bio }}
                </p>
            </div>
        </card>
        <card class="mb-3">
            <div>
                <h6 id="interest" class="mb-4 font-weight-light">Interest</h6>
                <ul class="list-unstyled mb-0">
                    <li v-if="person.interest === 'Empty'" class="medium-light-semibold bg-secondary d-inline-flex">-</li>
                    <li v-else class="medium-light-semibold bg-secondary d-inline-flex">{{ person.interest }}</li>
                </ul>
            </div>
        </card>
        <card class="d-block d-sm-none" v-if="person.contact !== null">
            <div>
                <h6 id="contact" class="mb-4 font-weight-light">Contact</h6>
            </div>
            <div class="d-flex">
                <fa icon="address-book" class="mr-4 fa-3x my-auto d-none d-sm-block"/>
                <fa icon="address-book" class="mr-4 fa-2x my-auto d-block d-sm-none"/>
                <div>
                    <h6 class="font-weight-bold mb-0 telephone">Telephone</h6>
                    <p v-if="person.contact === 'Empty'" class="mb-0">-</p>
                    <p v-else class="mb-0">{{ person.contact }}</p>
                </div>
            </div>
        </card>
    </div>
</template>

<style scoped>
    h4, .telephone{
        color: black;
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

    #general-profile {
        margin-top: 2vh;
    }

    #profile-identity {
        margin-left: 6vw;
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

    .scl-btn {
      padding-top: 5px;
      padding-bottom: 5px;
      padding-left: 11px;
      padding-right: 11px;
      font-size: 25px;
      width: 55px;
      text-align: center;
      margin:5px;
      color: white;
    }
    
    /* Hover Effect */
    .scl-btn:hover {
      opacity: 0.8;
      text-align: center;
      text-decoration: none;
      color: white;
    }

    .fa-whatsapp { background: #25D366; }

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
