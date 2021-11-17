<template>
    <div>
        <nav-bar
            v-bind:redirectLoc="'/student/'">

        </nav-bar>
        <div class="container section box mx-auto" style="height:70vh; margin-top: 120px; width: 80%;">
            <div class="row d-flex justify-content-center" style="margin-top: 50px;">
                <div class="col-sm-6 col-md-5 text-center" data-aos="fadeIn" data-aos-duration="1000">
                    <a href="" style="color: #FF7350; font-size: 24px;">STUDENT HOME</a>
                </div>
            </div>

            <div class="row d-flex justify-content-center" style="margin-top: 50px;">
                <subject-card
                    v-for="unit in units"
                    v-bind:key="unit.unitCode"
                    v-bind:unit="unit"
                    v-bind:url="'/student/assignments?unit='+unit.unitCode"
                    v-bind:isManageAssignment="true" v-bind:isManageStudent="false">
                </subject-card>
            </div>
            <div class="row d-flex justify-content-center" style="margin-top: 10px; margin-bottom: 120px;">
            </div>
        </div>
    </div>
</template>

<script>
import SubjectCard from "../subject-card";
import NavBar from "../nav-bar";
import config from "../../../../config";
import axios from "axios";

export default {
    name: "student-home",
    components: {SubjectCard, NavBar},
    data(){
        return {
            units: [],
        }
    },
    mounted() {
        this.getStudentUnits()
    },
    methods: {
        getStudentUnits() {
            let endpoint = config.BASE_URL + "api/student/get-units"

            axios.get(endpoint, {
                headers: {
                    'token': localStorage.token
                }
            }).then((response) => {
                this.units = response.data
            })
        }
    }
}
</script>

<style scoped>

</style>
