<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
?>
<div id="form" class="container">
<h1>  {{ title}}</h1>

    <form class="form" method="POST" action="#" @submit.prevent="submit">
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="inputFirstname">FirstName</label>
                <input type="text" v-model="form.first_name" class="form-control" placeholder="Firstname">
            </div>
            <div class="form-group col-md-6">
                <label for="inputPassword4">LastName</label>
                <input type="text" v-model="form.last_name" class="form-control"  placeholder="LastName">
            </div>
        </div>
        <div class="form-group">
            <label for="inputAddress">College</label>
            <input type="text" class="form-control" v-model="form.college"  placeholder="College/University">
        </div>

        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="inputCity">Branch</label>
                <input type="text" class="form-control" v-model="form.branch" id="inputCity">
            </div>
            <div class="form-group col-md-4">
                <label for="inputState">City</label>
                <input type="text" class="form-control" v-model="form.city" id="inputCity">
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Insert</button>
    </form>

    <br><br><br><br>

    <div class="">
    <table class="table table-bordered">
        <thead>
        <tr>
            <th scope="col">FirstName</th>
            <th scope="col">LastName</th>
            <th scope="col">College/University</th>
            <th scope="col">Branch</th>
            <th scope="col">City</th>
            <th scope="col">Action</th>
        </tr>
        </thead>
        <tbody>
        <tr v-for="value in users">
            <td>{{ value.first_name}}</td>
            <td>{{ value.last_name}}</td>
            <td>{{ value.college}}</td>
            <td>{{ value.branch}}</td>
            <td>{{ value.city}}</td>
            <td><button class="btn btn-danger btn-sm" @click="deleteUser(value.id)">Delete</button></td>
        </tr>

        </tbody>
    </table>
    </div>
</div>

<script>
    var form = new Vue({
        el: "#form",
        data : {
                title: "Information System",
                users: [],
                form: {
                    first_name: '',
                    last_name: '',
                    college: '',
                    branch: '',
                    city:'',
                },
            },
        methods: {
            submit() {
                axios.post("", this.form)
                    .then(response => {
                        console.log(this.form)
                        toastr.success('User added successfully');
                        this.form = "";

                        setTimeout(function (){
                            location.reload()
                        },1000)

                    }).catch(error => {
                    toastr.error('error occured');
                });
            },
            getAllUser() {
                axios.get("index.php/site/user").then(function (response) {
                    console.log(response.data)
                    form.users = response.data;
                }).catch(function (error) {
                        console.log(error);
                    });
            },
            deleteUser(id) {
                axios.get("index.php/site/delete/" + id)
                    .then(response => {
                        console.log(response);
                        toastr.success(response.data);
                        setTimeout(function (){
                            location.reload()
                        },1000)
                    }).catch(error => {
                    toastr.error('Error');
                });

            },
        },
        mounted() {
            this.getAllUser();
        },
    });
</script>
