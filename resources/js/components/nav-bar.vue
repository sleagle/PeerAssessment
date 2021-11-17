<template>
    <nav class="navbar navbar-expand-md fixed-top" style="background-color: #274f73;">
        <div class="container">
            <a class="navbar-brand"
               :href="redirectLoc" style="background-image: url(&quot;/img/pas-logo-light.svg&quot;);
                                      background-position: center;background-size: auto;background-repeat: no-repeat;
                                      width: 100px;height: 50px;">
            </a>
            <button type="button" data-toggle="collapse" class="navbar-toggler" data-target="#navcol-1">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navcol-1" style="width: 700px; margin-left: 30px;">
                <ul class="nav navbar-nav">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" href="#" style="color: #FFA500;">{{ userName }}</a>
                    </li>
                </ul>
                <form class="form-inline mr-auto" target="_self">
                </form>
                <a class="btn btn-light action-button" role="button" @click="logout" style="font-size: 14px;">Log Out</a>
            </div>
        </div>
    </nav>
</template>

<script>
    export default {
        name: "nav-bar",
        props: ['redirectLoc'],
        data() {
          return {
              userName: String
          }
        },
        mounted() {
            if (localStorage.userName) {
                this.userName = "Welcome " + localStorage.userName;
            }
        },
        methods: {
            logout: function () {
                localStorage.clear()
                window.location = '/home'
            }
        }
    }
</script>

<style scoped>

</style>
