<template>
  <card class="mt-3">
    <form @submit.prevent="update" @keydown="form.onKeydown($event)" method="POST" enctype="multipart/form-data">
      <alert-success :form="form" :message="$t('info_updated')" />

      <div class="form-group row">
        <div class="col">
          <img id="user-photo" class="rounded-circle" :src="person.image" alt="">
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
        <label class="col col-form-label font-weight-bold pt-0 pb-0">Full name *</label>
      </div>
      <div class="form-group row">
        <div class="col">
          <input v-model="form.name" :class="{ 'is-invalid': form.errors.has('name') }" class="form-control" type="text" name="name">
          <has-error :form="form" field="name" />
        </div>
      </div>

      <hr>

      <!-- About -->
      <div class="row">
        <label class="col col-form-label font-weight-bold pt-0 pb-0">About</label>
      </div>
      <div class="form-group row">
        <div class="col">
          <textarea v-model="person.bio" :class="{ 'is-invalid': form.errors.has('about') }" class="form-control" name="about"></textarea>
          <has-error :form="form" field="about" />
        </div>
      </div>

      <hr>

      <!-- Telephone -->
      <div class="row">
        <label class="col-md-3 col-form-label font-weight-bold pt-0 pb-0">Telephone</label>
      </div>
      <div class="form-group row">
        <div class="col">
          <input v-model="person.contact" :class="{ 'is-invalid': form.errors.has('telephone') }" class="form-control" type="number" name="telephone">
          <has-error :form="form" field="telephone" />
        </div>
      </div>

      <hr>

      <!-- Interest -->
      <div class="row">
        <label class="col-md-3 col-form-label font-weight-bold pt-0 pb-0">Interest</label>
      </div>
      <div class="form-group row">
        <div class="col">
          <input v-model="person.interest" :class="{ 'is-invalid': form.errors.has('interest') }" class="form-control" type="text" name="interest">
          <has-error :form="form" field="interest" />
        </div>
      </div>

      <hr class="mb-4">

      <!-- Submit Button -->
      <div class="row">
        <div class="col-md col-sm">
          <v-button :loading="form.busy" @click="update(person)">
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

  input, textarea {
    outline: 0;
    border-width: 0 0 0px;
    padding: 0;
    -webkit-text-fill-color: black;
  }

  input:focus, textarea:focus {
    box-shadow: none !important;
  }
</style>

<script>
import Form from 'vform'
import { mapGetters } from 'vuex'
import axios from 'axios'

export default {
  scrollToTop: false,

  metaInfo () {
    return { title: this.$t('settings') }
  },

  data: () => ({
    form: new Form({
      id: '',
      name: '',
      about: '',
      telephone: '',
      interest: ''
    })
  }),

  computed: mapGetters({
    user: 'auth/user',
    person: 'person'
  }),

  created () {
    // Fill the form with user data.
    this.form.keys().forEach(key => {
      this.form[key] = this.user[key]
    })
  },

  mounted() {
    this.$store.dispatch('fetchPerson', {
      id: this.form.id
    })
  },

  methods: {
    async update (person) {
      return axios.post('/api/update/' + this.person.id, {image: this.person.image, name: this.person.name, bio: this.person.bio, contact: this.person.contact, interest: this.person.interest})
      .then(res => {
        this.$store.dispatch(fetchPerson, {
          id: this.form.id
        }).catch((err) => {
          console.log(err);
        })
      })
    },
    onFileChange(e) {
      console.log(e.target.files[0]);
      const file = e.target.files[0];
      this.person.image = URL.createObjectURL(file);
    }
  }
}
</script>
