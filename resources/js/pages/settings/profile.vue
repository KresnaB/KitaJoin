<template>
  <card id="profile-card" class="mt-3 mb-3">
    <form @submit="update" @keydown="form.onKeydown($event)" method="POST" enctype="multipart/form-data">
      <alert-success :form="form" :message="$t('info_updated')" />

      <div class="form-group row">
        <div class="col">
          <img id="user-photo" class="rounded-circle" :src="person.image" alt="User image">
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
                <input id="image-input" type="file" class="form-control-file" @change="onFileChange" name="image">
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- About -->
      <div class="row">
        <label class="col col-form-label font-weight-bold pt-0 pb-0">About</label>
      </div>
      <div class="form-group row">
        <div class="col">
          <textarea v-model="person.bio" :class="{ 'is-invalid': form.errors.has('about') }" class="form-control" name="bio"></textarea>
          <has-error :form="form" field="about" />
        </div>
      </div>

      <hr>

      <!-- Telephone -->
      <div class="row">
        <label class="col-md-3 col-form-label font-weight-bold pt-0 pb-0">Telephone <span class="text-danger">*</span></label>
      </div>
      <div class="form-group row">
        <div class="col input-group">
          <div class="input-group-addon my-auto">+62</div>
          <input v-model="person.contact" :class="{ 'is-invalid': form.errors.has('telephone') }" class="form-control" type="tel" name="contact" required>
          <has-error :form="form" field="telephone" />
        </div>
      </div>

      <hr>

      <!-- Interest -->
      <div class="row">
        <label class="col-md-3 col-form-label font-weight-bold pt-0 pb-0">Interest <span class="text-danger">*</span></label>
      </div>
      <div class="form-group row">
        <div class="col">
          <input v-model="person.interest" :class="{ 'is-invalid': form.errors.has('interest') }" class="form-control" type="text" name="interest" required>
          <has-error :form="form" field="interest" />
        </div>
      </div>

      <hr class="mb-4">

      <!-- Submit Button -->
      <div class="row">
        <div class="col-md col-sm">
          <v-button :loading="form.busy"">
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

  @media (min-width: 768px) {
    .card {
      margin-top: 3vh !important;
    }
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
      about: '',
      telephone: '',
      interest: ''
    }),
    image: ''
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
    update(e) {
      e.preventDefault();
      let currentObj = this;

      const config = {
        headers: {'content-type': 'multipart/form-data'}
      }

      let formData = new FormData();
      var imageInput = document.getElementById('image-input');
      if (imageInput.files.length != 0) {
        formData.append('image', this.image);
      }
      if (this.person.bio === null) {
        formData.append('bio', '');
      } else {
        formData.append('bio', this.person.bio);
      }
      formData.append('contact', this.person.contact);
      formData.append('interest', this.person.interest);

      axios.post('/api/update/' + this.person.id, formData, config).then(function (response) {
        currentObj.success = response.data.success;
      }).catch(function (error) {
        currentObj.output = error;
      });

      this.$router.go();
    },
    onFileChange(e) {
      console.log(e.target.files[0]);
      this.image = e.target.files[0];
      this.person.image = URL.createObjectURL(this.image);
    }
  }
}
</script>
