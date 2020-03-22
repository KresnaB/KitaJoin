<template>
    <div>
        <h2 class="text-white text-center mt-5">Post your team on the #1 site for finding quality partners</h2>
        <card class="mt-5 mb-5">
            <label>Team title</label>
            <input class="form-control" type="text" name="title">
            <label>Team category</label>
            <input class="form-control" type="text" name="category"></input>
            <label>Team description</label>
            <textarea class="form-control" rows="4" name="description"></textarea>
            <v-button class="mt-4" :loading="form.busy">
                Proceed to checkout
            </v-button>
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
                title: '',
                category: '',
                description: ''
            })
        })
    }
</script>