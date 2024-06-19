<template>
  <v-container>
    <v-row>
      <v-col>
        <v-form ref="form" v-model="valid">
          <v-text-field v-model="name" :rules="nameRules" label="Nome" required></v-text-field>
          <v-text-field v-model="cpf" :rules="cpfRules" label="CPF" required></v-text-field>
          <v-text-field v-model="email" :rules="emailRules" label="Email" required></v-text-field>
          <v-text-field v-model="password" :rules="passwordRules" label="Senha" type="password"></v-text-field>
          <v-btn :disabled="!valid" color="primary" @click="submit">Enviar</v-btn>
        </v-form>
        <v-alert v-if="error" type="error">{{ error }}</v-alert>
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
export default {
  data() {
    return {
      valid: false,
      name: '',
      cpf: '',
      email: '',
      password: '',
      error: '',
      nameRules: [(v) => !!v || 'Nome é requerido.'],
      cpfRules: [(v) => !!v || 'CPF é requerido.'],
      emailRules: [
        (v) => !!v || 'Email é requerido.',
        (v) => /.+@.+/.test(v) || 'Insira um email válido.',
      ],
      passwordRules: [(v) => !!v || 'Senha é requerida.'],
    };
  },
  created() {
    this.fetchUser();
  },
  methods: {
    fetchUser() {
      const id = this.$route.params.id;
      this.axios.get(`/users/${id}`)
        .then(response => {
          this.name = response.data.name;
          this.cpf = response.data.cpf;
          this.email = response.data.email;
          this.password = response.data.password;
        })
        .catch(error => {
          console.error(error);
        });
    },
    submit() {
      const id = this.$route.params.id;
      this.axios.put(`/users/${id}`, {
        name: this.name,
        cpf: this.cpf,
        email: this.email,
        password: this.password,
      })
      .then(() => {
        this.$router.push('/');
      })
      .catch(error => {
        if (error.response && error.response.status === 422) {
          this.error = this.formatErrors(error.response.data.errors);
        } else {
          this.error = 'Erro inesperado.';
        }
      });
    },
    formatErrors(errors) {
      return Object.values(errors).flat().join(' ');
    }
  },
};
</script>
