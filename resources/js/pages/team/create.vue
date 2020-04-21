<template>
    <div>
        <h2 class="text-white text-center mt-5">Post your team on the #1 site for finding quality partners</h2>
        <card class="mt-5 mb-5">
            <form @submit.prevent="create" @keydown="form.onKeydown($event)">
                <label>Team name <span class="text-danger">*</span></label>
                <input class="form-control" type="text" v-model="form.post_name" required>
                <label class="mt-4">Contest category <span class="text-danger">*</span></label>
                <input class="form-control" type="text" v-model="form.category" required>
                <label class="mt-4">Team description <span class="text-danger">*</span></label>
                <textarea class="form-control" rows="4" v-model="form.description" required></textarea>
                <v-button class="mt-4" :loading="form.busy">
                    Proceed to checkout
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

    export default {
        data: () => ({
            form: new Form({
                post_name: '',
                category: '',
                description: ''
            })
        }),

        methods: {
            async create() {

                // Create the team
                const { data } = await this.form.post('/api/post/create')

                // Redirect home
                this.$router.push({ name: 'team' })
            }
        }
    }
</script>