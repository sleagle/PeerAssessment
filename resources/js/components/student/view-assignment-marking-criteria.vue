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
                    <a style="color: #ff7350;" href="#">&nbsp MARKING CRITERIA</a>
                </div>
                <!--======== Marking Criteria ===========-->

                <div class="section">
                    <div class="container fadeIn animated">
                        <br>
                        <h4 style="font-family: 'Noto Serif', serif; color: #274F73;">Marking Criteria</h4>
                        <br><br>

                        <!-- Assignment Marking Criteria-->
                        <h5 style="color: #274F73;"><strong>1. Assignment marking criteria </strong></h5>

                        <!--Table for assignment marking criteria -->
                        <div id="assignmentMarkingTable" class="col-sm-12">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th scope="col" width="17%" class="text-center" style="font-size: 14px;">Criteria</th>
                                    <th scope="col" width="17%" class="text-center" style="font-size: 14px;">(HD) High Distinction <p style="font-size: 12px;">(80% <= marks <= 100%)</p></th>
                                    <th scope="col" width="17%" class="text-center" style="font-size: 14px;">(DN) Distinction <p style="font-size: 12px;">(70% <= marks < 80%)</p></th>
                                    <th scope="col" width="17%" class="text-center" style="font-size: 14px;">(CR) Credit <p style="font-size: 12px;">(60% <= marks < 70%)</p></th>
                                    <th scope="col" width="16%" class="text-center" style="font-size: 14px;">(PP) Pass <p style="font-size: 12px;">(50% <= marks < 60%)</p></th>
                                    <th scope="col" width="16%" class="text-center" style="font-size: 14px;">(NN) Fail <p style="font-size: 12px;">(marks < 50%)</p></th>
                                </tr>
                                </thead>
                                <tbody>
                                    <assignment-criteria-row
                                        v-for="criteria in markingCriteria"
                                        v-bind:key="criteria.description"
                                        v-bind:criteria="criteria">

                                    </assignment-criteria-row>
                                </tbody>
                            </table>
                        </div>

                        <br><br>
                        <!-- Assignment Feedback Criteria-->
                        <h5 style="color: #274F73;"><strong>2. Feedback marking criteria </strong></h5>

                        <!--Table for Feedback marking criteria -->
                        <div id="feedbackMarkingTable" class="col-sm-12">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th scope="col" width="17%" class="text-center" style="font-size: 14px;">Criteria</th>
                                    <th scope="col" width="17%" class="text-center" style="font-size: 14px;">(HD) High Distinction <p style="font-size: 12px;">(80% <= marks <= 100%)</p></th>
                                    <th scope="col" width="17%" class="text-center" style="font-size: 14px;">(DN) Distinction <p style="font-size: 12px;">(70% <= marks < 80%)</p></th>
                                    <th scope="col" width="17%" class="text-center" style="font-size: 14px;">(CR) Credit <p style="font-size: 12px;">(60% <= marks < 70%)</p></th>
                                    <th scope="col" width="16%" class="text-center" style="font-size: 14px;">(PP) Pass <p style="font-size: 12px;">(50% <= marks < 60%)</p></th>
                                    <th scope="col" width="16%" class="text-center" style="font-size: 14px;">(NN) Fail <p style="font-size: 12px;">(marks < 50%)</p></th>
                                </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="feedbackCriterion in feedbackCriteria">
                                        <td align='center'>
                                            {{ feedbackCriterion.criteria }} ({{ feedbackCriterion.marks }})</td>
                                        <td align='center'>{{ feedbackCriterion.hdCriteria }}</td>
                                        <td align='center'>{{ feedbackCriterion.dnCriteria }}</td>
                                        <td align='center'>{{ feedbackCriterion.crCriteria }}</td>
                                        <td align='center'>{{ feedbackCriterion.ppCriteria }}</td>
                                        <td align='center'>{{ feedbackCriterion.nnCriteria }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <br>
                    </div>
                    <!-- End Assignment Feedback Criteria-->
                </div>
                <!--======== End Marking Criteria ===========-->
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
    name: "view-assignment-marking-criteria",
    mixins: [assignmentInfoMixin],
    data() {
        return {
            unitCode: '',
            markingCriteria: [],
            feedbackCriteria: []
        }
    },
    mounted() {
        this.loadAssignmentCriteriaData()
    },
    methods: {
        loadAssignmentCriteriaData() {
            let endpoint = config.BASE_URL + "api/assignment/" + this.assignmentId + "/marking-criteria"

            axios.get(endpoint, {
                headers: {
                    'token': localStorage.token
                }
            }).then((response) => {
                this.unitCode = response.data.unitCode
                this.markingCriteria = response.data.markingCriteria
                this.feedbackCriteria = response.data.feedbackCriteria
            })
        }
    }
}
</script>

<style scoped>

</style>
