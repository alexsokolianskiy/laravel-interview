<template>
    <table>
        <thead slot="head">
            <th>Username</th>
            <th>Frist name</th>
            <th>Last name</th>
            <th>Actions</th>
        </thead>
        <tbody>
            <tr>
                <td>
                    <input type="text" v-model="this.username" @input="applyFilters" />
                </td>
                <td>
                    <input type="text" v-model="this.first_name" @input="applyFilters" />
                </td>
                <td>
                    <input type="text" v-model="this.last_name" @input="applyFilters" />
                </td>
                <td>
                </td>
            </tr>
            <tr v-for="user in this.users" :key="user.id">
                <td>{{ user.username }}</td>
                <td>{{ user.first_name }}</td>
                <td>{{ user.last_name }}</td>
                <td>
                    <button :id="user.id" @click="removeUser">Delete</button>
                </td>
            </tr>
        </tbody>
    </table>
</template>

<script>
export default {
    data() {
        return {
            username: '',
            first_name: '',
            last_name: '',
            users: []
        }
    },
    created() {
        console.log(this.users)
    },
    mounted() {
        this.getData();
    },

    methods: {
        async getData() {
            const response = await fetch(`/users?${this.buildFiltersStr()}`);
            const json = await response.json();
            this.users = json;
        },
        buildFiltersStr() {
            const availableFilters = [
                'username',
                'first_name',
                'last_name'
            ];
            let filterStr = '';
            for (const filter of availableFilters) {
                if (this[filter]) {
                    filterStr += `${filter}=${this[filter]}&`
                }
            }
            return filterStr;
        },
        //here should be debounce to no spam server with queries
        async applyFilters() {
            await this.getData()
        },
        async removeUser(e) {
            console.log(e.target.id);
            const response = await fetch(`/users/remove/${e.target.id}`);
            const json = await response.json();
        }
    }
}
</script>
