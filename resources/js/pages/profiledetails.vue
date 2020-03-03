<template>
    <div class="p-3">
        <card id="general-profile" class="mb-3">
            <div class="d-flex">
                <img src="person.jpg" class="rounded-circle">
                <div id="profile-identity" class="my-auto">
                    <h4>{{ person.name }}</h4>
                    <h6>D3 Teknik Informatika</h6>
                </div>
            </div>
        </card>
        <card>
            <div>
            <h6 id="about">About</h6>
                <p>Lorem ipsum dolor sit amet, 
                    consectetur adipiscing elit, 
                    sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. 
                    Lectus mauris ultrices eros in cursus. 
                    Nisi scelerisque eu ultrices vitae. 
                </p>
            </div>
        </card>
    </div>
</template>

<style scoped>
    img {
        width: 31%;
        height: auto;
    }

    h4, #about{
        color: black;
    }

    h6, p {
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
        img {
            width: 279px;
            height: 279px;
        }

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
</style>

<script>
import { mapGetters } from 'vuex';

export default {
    mounted() {
        this.$store.dispatch('fetchPerson')
    },
    computed: {
        ...mapGetters([
        'person'
        ])
    },
    metaInfo () {
        return { title: this.$t('home') }
    },
    created() {
        this.person.id = this.$route.params.id;
    }
}
</script>