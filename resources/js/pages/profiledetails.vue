<template>
    <div class="p-3">
        <card id="general-profile" class="mb-3">
            <div class="d-flex">
                <img :src="person.image" class="rounded-circle img-responsive my-auto d-block d-sm-none" width="75" height="75">
                <img :src="person.image" class="rounded-circle img-responsive my-auto d-none d-sm-block" width="auto" height="130">
                <div id="profile-identity" class="my-auto">
                    <h4>{{ person.name }}</h4>
                    <h6>{{ person.program }}</h6>
                </div>
            </div>
        </card>
        <card class="mb-3" v-if="person.bio !== null">
            <div>
                <h6 id="about" class="mb-3">About</h6>
                <p class="mb-0">{{ person.bio }}
                </p>
            </div>
        </card>
        <card class="mb-3">
            <div>
                <h6 id="interest" class="mb-4">Interest</h6>
                <ul class="list-unstyled mb-0">
                    <li class="medium-light-semibold bg-secondary d-inline-flex">{{ person.interest }}</li>
                </ul>
            </div>
        </card>
        <card v-if="person.contact !== null">
            <div>
                <h6 id="contact" class="mb-4">Contact</h6>
            </div>
            <div class="d-flex">
                <fa icon="address-book" class="mr-4"/>
                <div>
                    <h6 id="telephone" class="font-weight-bold mb-0">Telephone</h6>
                    <p class="mb-0">{{ person.contact }}</p>
                </div>
            </div>
        </card>
    </div>
</template>

<style scoped>
    h4, #about, #interest, #telephone{
        color: black;
    }

    h6, p{
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

    @media (min-width: 1025px) {
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
</style>

<script>
import { mapGetters } from 'vuex';

export default {
    mounted() {
        this.$store.dispatch('fetchPerson', {
            id: this.$route.params.id
        })
    },
    computed: {
        ...mapGetters([
            'person'
        ])
    }
}
</script>