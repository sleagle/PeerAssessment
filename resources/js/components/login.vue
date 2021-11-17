<template>
    <div>
        <nav class="navbar navbar-expand-md fixed-top new-navbar">
            <div class="container">
                <a class="navbar-brand" href="/" style="background-image: url(&quot;/img/pas-logo-light.svg&quot;);
                background-position: center;background-size: auto;background-repeat: no-repeat;width: 100px;height: 50px;">
                </a>
                <div class="collapse navbar-collapse" id="navcol-1" style="width: 700px; margin-left: 30px;">

                    <form class="form-inline mr-auto" target="_self">
                    </form>
                    <a class="navbar-brand" href="https://www.utas.edu.au/mylo" style="color: #ffffff;
                background-position: center;background-size: auto;background-repeat: no-repeat;width: 200px;height: 40px;">
                        UNIVERSITY of TASMANIA
                    </a>
                </div>
            </div>
        </nav>
        <!--=========== Main class ===============-->
        <div style="text-align: center;">
            <!--======== Login Form ===========-->
            <div class="section">
                <br><br>
                <div class="justify-content-center" style="width: 90%; margin-top: 20px; display: inline-block;">
                    <br>
                    <div class="container box fadeIn animated" style="display: inline-block; width: 70%; margin-top: 50px;">
                        <!-- Input for requests from students-->
                        <div class="contact-clean" style="text-align: center;">
                            <!-- Title -->
                            <div class="w-md-75 w-lg-50 mx-md-auto mb-4 pt-2">
                                <h3 style="font-family: 'Abril Fatface', cursive; font-size: 30px; color: #274F73;">Welcome back!</h3>
                                <p style="color: #dd6446;">Login to Peer Assessment System!</p>
                            </div>
                            <!-- End Title -->

                            <!-- Icon -->
                            <div class="w-md-75 w-lg-50 mx-md-auto mb-2 pt-2">
                                <span><a href="/home"><img src="/img/pas-login-lock.svg" width="250"></a></span>
                            </div>
                            <!-- End Icon -->
                            <form method="POST" @submit="validateUser"
                                  style="display: inline-block; border-radius: 5px;" class="login-form" id="loginForm">
                                <div class="alert alert-danger add-criteria-required-error required-error"
                                     v-if="hasError" role="alert">
                                    {{errorMsg}}
                                </div>
                                <!--Form groups-->
                                <div class="form-group" style="text-align: center;">
                                    <input class="form-control" type="text" name="userName" placeholder="UserName"
                                           style="display: inline-block;" v-model="userName">
                                </div>
                                <div class="form-group" style="text-align: center;">
                                    <input type="password" class="form-control" name="password" placeholder="Password"
                                           style="display: inline-block;" v-model="password">
                                </div>
                                <div class="form-group">
                                    <button class="btn send-btn zoom" @click="validateUser">Login</button>
                                </div>
                                <div class="form-group fp-link"><a href="/forgot-password">Forgot password?</a></div>
                                <!--End Form groups-->
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!--======== End Login Form ===========-->
        </div>
        <!--=========== End Main class ===============-->
    </div>
</template>

<script>
import axios from 'axios'
import config from "../../../config";

export default {
    name: "login",
    data() {
        return {
            userName: '',
            password: '',
            errorMsg: '',
            hasError: false
        }
    },
    methods: {
        validateUser: function(e) {
            e.preventDefault();
            if (!this.userName || !this.password) {
                this.hasError = true;
                this.errorMsg = "All fields are Required!"
            }
            else {
                let password = btoa(this.password);
                let formAction = config.BASE_URL + 'api/user/login';
                this.hasError = false;
                this.errorMsg = ""

                axios.post(formAction, {
                    username: this.userName,
                    password: password
                })
                    .then(function (response) {
                        localStorage.userName = response.data.userName;
                        localStorage.token = response.data.token;

                        switch (response.data.userType) {
                            case "Admin":
                                window.location = "/admin/";
                                break;
                            case "Lecturer":
                                window.location = "/lecturer/";
                                break;
                            case "Student":
                                window.location = "/student/";
                                break;
                        }
                    })
                    .catch((error) => {
                        this.hasError = true;
                        this.errorMsg = error.response.data.errorMessage;
                    });
            }
        }
    }
}
</script>

<style scoped>

</style>
