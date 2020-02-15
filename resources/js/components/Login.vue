<template>
  <div class="d-flex justify-content-center align-items-center bg-light flex-column h-100">
    <h1 class="my-3 text-secondary display-3 w-auto mx-auto">PHARMA</h1>
    <b-form @submit.prevent="Log">
      <b-form-group
        class="mx-auto"
        label="Authenticate"
        label-class="text-center text-secondary lead"
        style="width: 350px;"
      >
        <b-form-input
          id="name"
          v-model="userlogin"
          type="text"
          required
          placeholder="Login"
          class="my-2"
          size="lg"
        ></b-form-input>

        <b-form-input
          id="pass"
          v-model="userpass"
          type="text"
          required
          placeholder="Password"
          class="my-2"
          size="lg"
        ></b-form-input>
      </b-form-group>

      <div class="d-flex justify-content-center my-3">
        <b-button type="submit" variant="info" style="min-width:70px;">Save</b-button>
      </div>
    </b-form>
  </div>
</template>

<script>
export default {
  // <img src="./storage/images/LOGO.png" class="my-3" />
  name: "Login",
  title: "Login",
  data: function() {
    return {
      userlogin: null,
      userpass: null
    };
  },
  computed: {
    // for register component instead
    available: function() {
      return (
        this.userlogin &&
        this.names.find(name => this.userlogin.trim() === name.trim()) ===
          undefined
      );
    },
    /**
     *    :state="valid"
          invalid-feedback="Password must be atleast 5 characters long"
          valid-feedback="Good"
     */
    valid: function() {
      return this.userpass && this.userpass.length >= 5;
    }
  },
  methods: {
    Log() {
      this.$http
        .post("/api/login", { username: this.userlogin, password: this.userpass })
        .then(res => {
          if (res.ok) {
            this.$store.commit("setLogged", true);
            this.$router.push("/");
          }
        })
        .catch(error => {
          // do something here
        });
    }
  },
  created() {
    this.fetchNames();
    this.$store.commit("setLogged", false);
  }
};
</script>

<style lang="scss" scoped>
</style>
