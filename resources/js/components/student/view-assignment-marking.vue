<template>
    <div>
        <nav-bar
            v-bind:redirectLoc="'/student/'">

        </nav-bar>
        <section id="main" style="height: 100%;">
            <view-assignment-sidebar v-bind:assignment-id="assignmentId" v-bind:current-view="currentView">

            </view-assignment-sidebar>
            <div class="main">
                <div class="container box mx-auto" style="width: 90%; margin-top: 100px;">
                <div class="row d-flex pl-4" style="margin-top: 10px;">
                    <a style="color: #274F73;" href="/student/">HOME /</a>
                    <a style="color: #274F73;" :href="'/student/assignments?unit='+unitCode">&nbsp {{ unitCode }} /</a>
                    <a style="color: #ff7350;" href="#">&nbsp ASSIGNMENT MARKING</a>
                </div>
                <div class="section">
                    <div class="container fadeIn animated">
                        <br>
                        <h4 style="font-family: 'Noto Serif', serif; color: #274F73;">Assignment Marking</h4>
                        <br><br>

                        <!-- Assignment Marking Criteria-->
                        <h5 style="color: #274F73;"><strong>Assignment marking criteria </strong></h5>
                        <ul>
                            <li v-for="criterion in criteria">CRA{{ criterion.rowNum }}: {{ criterion.criteria }}</li>
                        </ul>

                        <!--Table of assignments -->
                        <div>
                            <table class="table table-bordered">
                                <thead>
                                <tr class="text-center">
                                    <td>#</td>
                                    <td>Student work</td>
                                    <td>CRA1</td>
                                    <td>CRA2</td>
                                    <td>CRA3</td>
                                    <td>CRA4</td>
                                    <td>CRA5</td>
                                    <td>Total</td>
                                    <td>Action</td>
                                </tr>
                                </thead>
                                <tbody>
                                <tr class="text-center" v-for="marking in markings">
                                    <td>1</td>
                                    <td><a :href="marking.file" target="blank">student 1 work</a></td>
                                    <td>0</td>
                                    <td>0</td>
                                    <td>0</td>
                                    <td>0</td>
                                    <td>0</td>
                                    <td>0</td>
                                    <td>
                                        <div class="dropdown show">
                                            <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Actions
                                            </a>

                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                <a class="dropdown-item" :href="'/student/view/assignment/'+assignmentId+'/mark/'+marking.reviewId">Mark/Edit</a>
                                                <a class="dropdown-item" href="" data-toggle="modal" data-target="#viewComments">View Comments</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <!-- End Table of assignments -->
                        <br><br>
                    </div>
                </div>
                </div>
            </div>
        </section>
    </div>
</template>

<script>
import assignmentInfoMixin from "../../mixins/assignmentInfoMixin";
import config from "../../../../config";
import axios from "axios";

export default {
    name: "view-assignment-marking",
    mixins: [assignmentInfoMixin],
    data() {
        return {
            unitCode: '',
            criteria: [],
            markings: []
        }
    },
    mounted() {
        this.loadAssignmentPeerMarking()
    },
    methods: {
        loadAssignmentPeerMarking() {
            let endpoint = config.BASE_URL + "api/student/assignment/" + this.assignmentId + "/reviews"

            axios.get(endpoint, {
                headers: {
                    'token': localStorage.token
                }
            }).then((response) => {
                this.unitCode = response.data.unitCode
                this.criteria = response.data.criteria
                this.markings = response.data.marking
            })
        }
    }
}
</script>

<style scoped>

</style>
