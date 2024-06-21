<template>
  <v-container>
    <v-row>
      <v-col>
        <h2>Lista de Usuários</h2>
        <v-btn color="primary" @click="createUser">Criar Usuário</v-btn>
        <v-data-table
          :headers="headers"
          :items="users"
          class="elevation-1"
          v-if="users.length > 0"
        >
          <template v-slot:item.actions="{ item }">
            <v-icon small @click="editUser(item)">mdi-pencil</v-icon>
            <v-icon small @click="deleteUser(item.id)">mdi-delete</v-icon>
            <v-icon small @click="showUser(item.id)">mdi-eye</v-icon>
          </template>
        </v-data-table>
        <div v-else>
          <p>Nenhum usuário cadastrado.</p>
        </div>
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
export default {
  data() {
    return {
      users: [],
      headers: [
        { text: 'Name', value: 'name' },
        { text: 'CPF', value: 'cpf' },
        { text: 'Email', value: 'email' },
        { text: 'Actions', value: 'actions', sortable: false },
      ],
    };
  },
  methods: {
    fetchUsers() {
      this.axios.get('/users')
        .then(response => {
          this.users = response.data;
        })
        .catch(error => {
          console.error(error);
        });
    },
    createUser() {
      this.$router.push('/create');
    },
    editUser(user) {
      this.$router.push(`/edit/${user.id}`);
    },
    deleteUser(id) {
      this.axios.delete(`/users/${id}`)
        .then(() => {
          this.fetchUsers();
        })
        .catch(error => {
          console.error(error);
        });
    },
    showUser(id) {
      this.$router.push(`/show/${id}`);
    }
  },
  mounted() {
    this.fetchUsers();
  },
};
</script>

<style scoped>
.v-data-table {
  margin-top: 20px;
}
</style>
