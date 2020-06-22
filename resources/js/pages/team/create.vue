<template>
    <div>
        <div id="not-available" class="d-none d-sm-block d-sm-none d-md-block">
            <div id="not-available-container" class="bg-white text-center pt-3 pb-3">
                <fa id="laptop" icon="laptop"></fa>
                <h1 id="oops" class="font-weight-normal">Oops!</h1>
                <p class="mt-4 font-weight-normal">Sorry, we're only available in mobile right now. We'll let you know as soon as we are!</p>
            </div>
        </div>
        <div class="d-block d-sm-none d-none d-sm-block d-md-none">
            <h2 class="text-center mt-5">Post your team on the #1 site for finding quality teams</h2>
            <card class="my-40 background-color-black">
                <form @submit.prevent="create" @keydown="form.onKeydown($event)">
                    <label id="team-name-label" class="text-white mb-0">Team name <span class="text-danger">*</span></label>
                    <input id="team-name-input" class="form-control mt-2 background-color-black" type="text" v-model="form.post_name" required>
                    <label id="contest-category-label" class="mt-28 mb-0 text-white">Contest category <span class="text-danger">*</span></label>
                    <input id="contest-category-input" class="form-control mt-2 background-color-black" type="text" v-model="form.category" required>
                    <label id="team-description-label" class="mt-28 mb-0 text-white">Team description <span class="text-danger">*</span></label>
                    <textarea id="team-description-textarea" class="form-control mt-2 background-color-black" rows="4" v-model="form.description" required></textarea>
                    <v-button class="mt-4 py-15 background-color-1" :loading="form.busy">
                        Save
                    </v-button>
                </form>
            </card>
        </div>
    </div>
</template>

<style scoped>
    .card {
        padding: 8px;
    }

    .mt-28 {
        margin-top: 28px;
    }

    .my-40 {
        margin-top: 40px;
        margin-bottom: 40px;
    }

    .background-color-black {
        background-color: black;
    }

    .background-color-1 {
        background-color: #F38704;
    }

    #team-name-input, #contest-category-input, #team-description-textarea {
        -webkit-text-fill-color: white; 
    }

    input:focus, textarea:focus{
        box-shadow: none !important;
        border-color: white;
    }

    #not-available {
        padding: 120px;
    }

    #not-available p {
        margin-bottom: 36px;
        font-size: 1.125em;
        color: #A7A7A7;
    }

    #not-available-container {
        padding-left: 80px;
        padding-right: 80px;
    }

    #laptop {
        width: 180px;
        height: 216px;
    }

    @media (max-width: 1000px) {
        #team-name-label, #contest-category-label, #team-description-label {
            font-size: 0.825rem;
        }
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