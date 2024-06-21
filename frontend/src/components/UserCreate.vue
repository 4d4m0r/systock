<template>
  <v-container>
    <h2>Criar Usuário</h2>
    <v-row>
      <v-col>
        <v-form ref="form" v-model="valid">
          <v-text-field v-model="name" :rules="nameRules" label="Nome" required></v-text-field>
          <v-text-field v-model="cpf" :rules="cpfRules" label="CPF" required></v-text-field>
          <v-text-field v-model="email" :rules="emailRules" label="Email" required></v-text-field>
          <v-text-field v-model="password" :rules="passwordRules" label="Senha" type="password" required></v-text-field>
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
      nameRules: [
        v => !!v || 'Nome é requerido.',
        v => (v && v.length <= 255) || 'Nome deve ter no máximo 255 caracteres.',
      ],
      cpfRules: [
        v => !!v || 'CPF é requerido.',
        v => /^[0-9]{11}$/.test(v) || 'CPF deve ter exatamente 11 dígitos numéricos.',
      ],
      emailRules: [
        v => !!v || 'Email é requerido.',
        v => /.+@.+/.test(v) || 'Insira um email válido.',
      ],
      passwordRules: [
        v => !!v || 'Senha é requerida.',
        v => (v && v.length >= 6) || 'Senha deve ter pelo menos 6 caracteres.',
      ],
    };
  },
  methods: {
    submit() {
      this.error = '';
      this.axios.post('/users', {
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
    },
  },
};
</script>
