<template>
    <div class="container">
        <h2>Bookstore users</h2>
        <nav aria-label="Page navigation example">
            <ul class="pagination">
                <li v-bind:class="[{disabled: !pagination.prev_page_url}]"
                class="page-item"><a class="page-link" href="#"
                @click="fetchUsers(pagination.prev_page_url)">Previous</a></li>

                <li class="page-item disabled"><a class="page-link text-dark" href="#">
                    Page {{ pagination.current_page }} of {{ pagination.last_page }}</a></li>

                <li v-bind:class="[{disabled: !pagination.next_page_url}]"
                class="page-item"><a class="page-link" href="#"
                @click="fetchUsers(pagination.next_page_url)">Next</a></li>
            </ul>
        </nav>
        <div class="card card-body mb-3" v-for="user in users"
        v-bind:key="user.id">
            <h2>{{ user.name }}</h2>
            <h3>{{ user.email }}</h3>
            <p>{{ user.address }}</p>
            <button class="btn btn-danger mb-2" @click="deleteUser(user.id)">Delete</button>
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

    created(){
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
                    vm.makePagination(res.meta, res.links)
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

        deleteUser(id){
            if(confirm('Are you sure?')){
                fetch(`api/user/${id}`, {
                    method: 'delete'
                })
                .then(res => res.json())
                .then(data => {
                    alert('User removed');
                    this.fetchUsers();
                }).catch(err => console.log(err));
            }
        },
    }
}

</script>

