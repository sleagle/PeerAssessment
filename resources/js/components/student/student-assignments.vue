<template>
    <div>
        <nav-bar
            v-bind:redirectLoc="'/student/'">

        </nav-bar>
        <div class="container section box mx-auto" style="margin-top: 100px; width:85%; height: 70vh;">
            <div class="row direction d-flex pl-3" style="margin-top:10px; padding: 5px;">
                <a style="color: #274F73;" href="/student/">HOME /</a>
                <a style="color: #ff7350;" href="#">&nbsp {{ unitCode }}</a>
            </div>
            <div class="assignment-show" style="margin-top: 20px;">
                <!----- Tab of units' name -------->
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link active" role="tab" data-toggle="tab" href="#tab-1">Current Assignments</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" role="tab" data-toggle="tab" href="#tab-2">Past Assignments</a>
                    </li>
                </ul>
                <!------- Tabs content --------->
                <div class="tab-content">
                    <!------- Current Assignments ------>
                    <div class="tab-pane active" role="tabpanel" id="tab-1">
                        <div class="assignments">
                            <table class="table">
                                <thead>
                                <tr>
                                    <td><strong>Assignment title</strong></td>
                                    <td><strong>Due Date</strong></td>
                                </tr>
                                </thead>
                                <tbody>
                                <tr v-for="current in currentAssignments">
                                    <td>
                                        <a :href="'/student/view/assignment/'+current.id+'/info'">
                                            {{ current.title }}
                                        </a>
                                    </td>
                                    <td>{{ current.dueDate }}</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!------- End Current Assignments -------->

                    <!------- Past Assginments --------->
                    <div class="tab-pane" role="tabpanel" id="tab-2">
                        <div class="assignments">
                            <div class="select-assignment my-3 ml-3">
                                <label for="select-sem">Filter Results: </label>
                                <select id="select-sem" style="height: 40px;;" v-model="currentFilter">
                                    <option value="all">All Semesters</option>
                                    <option v-for="offering in offerings" :value="offering">{{ offering }}</option>
                                </select>
                            </div>
                            <!-------- Hidden div ---------->
                                <br>
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <td><strong>Assignment title</strong></td>
                                        <td><strong>Due Date</strong></td>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr v-for="past in filteredOfferings">
                                        <td>
                                            <a :href="'/student/view/assignment/'+past.id+'/info'">
                                                {{ past.title }}
                                            </a>
                                        </td>
                                        <td>{{ past.dueDate }}</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <!----------- End hidden div--------->
                        </div>
                    </div>
                    <!------- End Past Assignments -------->
                </div>
                <!------- End Tabs Content --------->
            </div>
            </div>
        </div>
    </div>
</template>

<script>
import NavBar from "../nav-bar";
import routeDetailsMixin from "../../mixins/routeDetailsMixin";
import config from "../../../../config";
import axios from "axios";

export default {
    name: "student-assignments",
    components: {NavBar},
    mixins: [routeDetailsMixin],
    data() {
        return {
            currentAssignments: [],
            pastAssignments: [],
            offerings: [],
            currentFilter: 'all'
        }
    },
    computed: {
        filteredOfferings() {
            const self =this;
            if (self.currentFilter === 'all') {
                return self.pastAssignments;
            } else {
                return self.pastAssignments.filter(function(past) {
                    return past.yearNSemester === self.currentFilter;
                });
            }
        }
    },
    mounted() {
        this.getPastEnrollments()
        this.getUnitAssignments()
    },
    methods: {
        getPastEnrollments(){
            let endpoint = config.BASE_URL + "api/student/unit/pass-enrollments/"+this.unitCode

            axios.get(endpoint, {
                headers: {
                    'token': localStorage.token
                }
            }).then((response) => {
                this.offerings = response.data
            })
        },
        getUnitAssignments() {
            let endpoint = config.BASE_URL + "api/student/unit/assignments/"+this.unitCode

            axios.get(endpoint, {
                headers: {
                    'token': localStorage.token
                }
            }).then((response) => {
                this.currentAssignments = response.data.currentAssignments
                this.pastAssignments = response.data.pastAssignments
            })
        }
    }
}
</script>

<style scoped>

</style>
