<template>
  <table class="table">
    <thead>
      <tr>
        <th scope="col">Username</th>
        <th scope="col">Name</th>
        <th scope="col">Surname</th>
        <th scope="col">Email</th>
        <th scope="col">Created</th>
        <th scope="col">Status</th>
        <th scope="col">Actions</th>
      </tr>
    </thead>
    <tbody>
      <tr v-for="item in items" :key="item.id">
        <th scope="row">
            username
        </th>
        <td>
            name
        </td>
        <td>
            surname
        </td>
        <td>
            email
        </td>
        <td>
            created
        </td>
        <td>
            status
        </td>
        <td>
            button
        </td>
      </tr>
    </tbody>
  </table>
</template>

<script>
export default {
    data(){
        return {
            items: {},
        }
    },
    methods: {
        async getUsers(){
            await axios.get("/users")
                .then(response => {
                    console.log(response)
                })
                .catch(error => {
                    console.log(error)
                })
        }
    }
}
</script>

<style>

</style>