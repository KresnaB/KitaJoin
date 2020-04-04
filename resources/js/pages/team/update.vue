<template>
    <div>
        <card class="mt-3 mb-5">
            <form @submit.prevent="update" @keydown="form.onKeydown($event)" method="POST">
                <label>Contest name *</label>
                <input class="form-control" type="text" v-model="team.post_name" required>
                <label>Contest category *</label>
                <input class="form-control" type="text" v-model="team.category" required>
                <label>Team description *</label>
                <textarea class="form-control" rows="4" v-model="team.description" required></textarea>
                <v-button class="mt-4" :loading="form.busy">
                   Save
                </v-button>
            </form>
        </card>
    </div>
</template>

<style scoped>
    .card {
        padding: 8px;
    }
</style>

<script>1
    import Form from 'vform'
    import { mapGetters } from 'vuex';
    import axios from 'axios'

    export default {

        data: () => ({
            form: new Form({
                post_name: null,
                category: null,
                description: null
            })
        }),

        computed: mapGetters({
            team: 'team',
        }),

        mounted () {
            this.$store.dispatch('fetchTeam', {
                id: this.$route.params.id
            })
        },

        methods: {
            async create() {

                // Create the team
                const { data } = await this.form.post('/api/post/create')

                // Redirect home
                this.$router.push({ name: 'team' })
            },

            update(e) {
                e.preventDefault();
                let currentObj = this;

                let formData = new FormData();
                formData.append('post_name', this.team.post_name);
                formData.append('category', this.team.category);
                formData.append('description', this.team.description);

                axios.post('/api/post/update/' + this.team.id, formData).then(function (response) {
                    currentObj.success = response.data.success;
                }).catch(function (error) {
                    currentObj.output = error;
                });

                this.$router.push({ name: 'team.details', params: {id: this.$route.params.id} })
            },
        }
    }
</script>