<template>
    <div class="container">
        <h2>Bookstore users</h2>
        <div class="card card-body mb-3" v-for="user in users"
        v-bind:key="user.id">
            <h2>{{ user.name }}</h2>
            <h3>{{ user.email }}</h3>
            <p>{{ user.address }}</p>
        </div>
    </div>
</template>

<script>
export default {
    data(){
        return {
            users: [],
            user: {
                id: '',
                name: '',
                email: '',
                address: ''
            },
            pagination:{}
        }
    },

    create(){
        this.fetchUsers();
    },

    methods: {
        fetchUsers(page_url){
            let vm = this;
            page_url = page_url || '/api/users'
            fetch(page_url)
                .then(res => res.json())
                .then(res => {
                    this.users = res.data;
                }).catch(err => console.log(err));
        },

        makePagination(meta, links){
            let pagination = {
                current_page: meta.current_page,
                last_page: meta.last_page,
                next_page_url: links.next,
                prev_page_url: links.prev
            };
            this.pagination = pagination;
        },
    }
}

</script>

