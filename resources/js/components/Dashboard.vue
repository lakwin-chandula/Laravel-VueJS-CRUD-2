<template>
    <div>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <button
                        @click.prevent="fireModal()"
                        type="button"
                        class="btn btn-primary"
                        data-toggle="modal"
                        data-target="#addCustomerModal"
                    >
                        Add Customer
                    </button>
                </div>
            </div>
            <div class="row">
                <!-- <pre>{{customers}}</pre> -->
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Id</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(customer, index) in customers" :key="index">
                            <!-- <tr v-for="(customer, value) in customers" :value="customer.id"> -->
                            <!-- <tr v-for="customer in customers" :key="customer.id"> -->
                            <!-- <tr v-for="customer in Customers" v-bind:key="customer.id"> -->
                            <!-- <pre>{{customer.name}}</pre> -->
                            <!-- {{value}} -->
                            <td>{{ customer.id }}</td>
                            <td>{{ customer.name }}</td>
                            <td>{{ customer.email }}</td>
                            <button
                                @click.prevent="customerEdit(index)"
                                type="button"
                                class="btn btn-success"
                            >
                                Edit
                            </button>
                            <button
                                @click.prevent="customerDelete(index)"
                                type="button"
                                class="btn btn-danger"
                            >
                                Delete
                            </button>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- modal -->
        <div id="addCustomerModal" class="modal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Modal title</h5>
                        <button
                            type="button"
                            class="close"
                            data-dismiss="modal"
                            aria-label="Close"
                        >
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    id="name"
                                    placeholder="Enter name"
                                    v-model="name"
                                />
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input
                                    type="email"
                                    class="form-control"
                                    id="email"
                                    placeholder="Enter email"
                                    v-model="email"
                                />
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button
                            @click="submit"
                            type="button"
                            class="btn btn-primary"
                        >
                            Save changes
                        </button>
                        <button
                            type="button"
                            class="btn btn-secondary"
                            data-dismiss="modal"
                        >
                            Close
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            name: "",
            email: "",
            customers: [],
        };
    },
    mounted() {
        this.getData();
    },
    methods: {
        clearInputs() {
            this.id = "";
            this.name = "";
            this.email = "";
        },
        getData() {
            axios.post("api/get-customers").then(res => {
                // console.log(res.data.customers);
                this.customers = res.data.customers;
            });
        },
        fireModal() {
            this.clearInputs();
            $("#addCustomerModal").on("shown.bs.modal", function() {
                $("#name").trigger("focus");
            });
        },
        submit() {
            if (this.id === "") {
                // add customer
                let saveData = {
                    name: this.name,
                    email: this.email
                };
                axios.post("api/create-customer", saveData).then(res => {
                    // console.log(res.data.data);
                    if (res.data.data) {
                        $("#addCustomerModal").modal("hide");
                        this.clearInputs();
                    }
                });
                this.getData();
            } else {
                //edit customer
                let updateData = {
                    id: this.id,
                    name: this.name,
                    email: this.email
                };
                axios.post("api/edit-customer", updateData).then(res => {
                    // console.log(res.data);
                    if (res.data) {
                        $("#addCustomerModal").modal("hide");
                        this.clearInputs();
                    }
                });
                this.getData();
            }
        },
        customerEdit(index) {
            // console.log(index);
            let editData = this.customers[index];
            this.id = editData.id;
            this.name = editData.name;
            this.email = editData.email;
            $("#addCustomerModal").modal("show");
        },
        customerDelete(index) {
            let deleteCustomer = this.customers[index];
            axios.post("api/delete-customers", deleteCustomer).then(res => {
                // console.log(res.data);
                if (res.data) {
                    this.getData();
                }
            });
        }
    }
};
</script>
