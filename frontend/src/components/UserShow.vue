<template>
  <v-container>
    <v-card variant="tonal">
      <v-card-title>Detalhes do usuário</v-card-title>
      <v-card-text>
        <v-list>
          <v-list-item>
            <v-list-item-content>
              <v-list-item-title>Nome</v-list-item-title>
              <v-list-item-subtitle>{{ name }}</v-list-item-subtitle>
            </v-list-item-content>
          </v-list-item>
          <v-list-item>
            <v-list-item-content>
              <v-list-item-title>CPF</v-list-item-title>
              <v-list-item-subtitle>{{ cpf }}</v-list-item-subtitle>
            </v-list-item-content>
          </v-list-item>
          <v-list-item>
            <v-list-item-content>
              <v-list-item-title>Email</v-list-item-title>
              <v-list-item-subtitle>{{ email }}</v-list-item-subtitle>
            </v-list-item-content>
          </v-list-item>
        </v-list>
      </v-card-text>
    </v-card>
  </v-container>
</template>

<script>
export default {
  data() {
    return {
      name: '',
      cpf: '',
      email: '',
      error: ''
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
        })
        .catch(error => {
          console.error(error);
        });
    }
  },
};
</script>
