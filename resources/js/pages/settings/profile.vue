<template>
  <card class="mt-3">
    <form @submit.prevent="update" @keydown="form.onKeydown($event)">
      <alert-success :form="form" :message="$t('info_updated')" />

      <div class="form-group row">
        <div class="col">
          <img id="user-photo" class="rounded-circle" :src="url" alt="">
        </div>
      </div>

      <div class="form-group row">
        <a id="change-photo" href="#" data-toggle="modal" data-target="#modal-user-photo">
          Change photo
        </a>
      </div>

      <div id="modal-user-photo" class="modal" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Change photo</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div>
                <input type="file" class="form-control-file" @change="onFileChange">
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Name -->
      <div class="row">
        <label class="col col-form-label font-weight-bold pt-0 pb-0">Full name</label>
      </div>
      <div class="form-group row">
        <div class="col">
          <input v-model="form.name" :class="{ 'is-invalid': form.errors.has('name') }" class="form-control" type="text" name="name">
          <has-error :form="form" field="name" />
        </div>
      </div>

      <hr>

      <!-- Email -->
      <div class="row">
        <label class="col-md-3 col-form-label font-weight-bold pt-0 pb-0">{{ $t('email') }}</label>
      </div>
      <div class="form-group row">
        <div class="col">
          <input v-model="form.email" :class="{ 'is-invalid': form.errors.has('email') }" class="form-control" type="email" name="email">
          <has-error :form="form" field="email" />
        </div>
      </div>

      <!-- Submit Button -->
      <div class="form-group row">
        <div">
          <v-button :loading="form.busy">
            Save
          </v-button>
        </div>
      </div>
    </form>
  </card>
</template>

<style scoped>
  #user-photo {
    width: 140px;
    height: 140px;
    margin: auto;
    display: block;
  }

  #change-photo {
    margin: 0 auto;
    color: #B1C1C8;
  }

  input {
    outline: 0;
    border-width: 0 0 0px;
    padding: 0;
    -webkit-text-fill-color: black;
  }

  input:focus {
    box-shadow: none !important;
  }
</style>

<script>
import Form from 'vform'
import { mapGetters } from 'vuex'

export default {
  scrollToTop: false,

  metaInfo () {
    return { title: this.$t('settings') }
  },

  data: () => ({
    form: new Form({
      name: '',
      email: ''
    }),
    url: null
  }),

  computed: mapGetters({
    user: 'auth/user'
  }),

  created () {
    // Fill the form with user data.
    this.form.keys().forEach(key => {
      this.form[key] = this.user[key]
    })
  },

  methods: {
    async update () {
      const { data } = await this.form.patch('/api/settings/profile')

      this.$store.dispatch('auth/updateUser', { user: data })
    },
    onFileChange(e) {
      console.log(e.target.files[0]);
      const file = e.target.files[0];
      this.url = URL.createObjectURL(file);
    }
  }
}
</script>
