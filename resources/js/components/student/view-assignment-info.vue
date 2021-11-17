<template>
    <div>
        <nav-bar
            v-bind:redirectLoc="'/student/'">

        </nav-bar>
        <section id="main" style="height: 100%;">
            <!--==========Side navbar==========-->
            <view-assignment-sidebar v-bind:assignment-id="assignmentId" v-bind:current-view="currentView">

            </view-assignment-sidebar>
            <!--==========End Side Navbar===========-->

            <!--=========== Main class ===============-->
            <div class="main">
                <div class="container box mx-auto" style="width: 90%; margin-top: 100px;">
                <div class="row d-flex pl-4 pt-3 direction" style="margin-bottom: 20px; margin-left: 10px;">
                    <a style="color: #274F73;" href="/student/">HOME /</a>
                    <a style="color: #274F73;" :href="'/student/assignments?unit='+unitCode">&nbsp {{ unitCode }} /</a>
                    <a style="color: #ff7350;" href="#">&nbsp ASSIGNMENT OVERVIEW</a>
                </div>

                <!--====Basic Description=======-->
                <div class="section">
                    <div class="container fadeIn animated">
                        <h4 style="font-family: 'Noto Serif', serif; color: #274F73; margin-left: 20px;">Assignment Information</h4>
                        <lable style="margin-left: 22px;"><b>Unit name:</b></lable> <br>
                        <label style="margin-left: 20px;">{{ unit }}</label>
                        <br><br>
                        <lable style="margin-left: 20px;"><b>Assignment title:</b></lable><br>
                        <label style="margin-left: 20px;">{{ title }}</label>
                        <br><br>
                        <lable style="margin-left: 20px;"><b>Learning Outcomes</b></lable>
                        <br>
                        <p style="margin-left: 20px; margin-right: 20px;">
                            {{ learningOutcome }}
                        </p>
                        <br>
                        <lable style="margin-left: 20px;"><b>Scenario</b></lable>
                        <br>
                        <p style="margin-left: 20px; margin-right: 20px;">
                            {{ scenario }}
                        </p>
                        <lable style="margin-left: 20px;"><b>Deadlines</b></lable>
                        <table style="margin-left: 20px;">
                            <tbody>
                            <tr>
                                <td>Topic Selection Closing Date</td><td>{{ topicSelection }}</td>
                            </tr>
                            <tr>
                                <td>Assignment Submission Deadline</td><td>{{ assignmentSubmission }}</td>
                            </tr>
                            <tr>
                                <td>Assignment Submission Closing Date</td><td>{{ assignmentSubmissionClosing }}</td>
                            </tr>
                            <tr>
                                <td>Assignment Marking Opening Date</td><td>{{ assignmentMarkingOpening }}</td>
                            </tr>
                            <tr>
                                <td>Assignment Marking Closing Date</td><td>{{ assignmentMarkingClosing }}</td>
                            </tr>
                            <tr>
                                <td>Feedback Marking Opening Date</td><td>{{ assignmentFeedbackMarkingOpening }}</td>
                            </tr>
                            <tr>
                                <td>Feedback Marking Closing Date</td><td>{{ assignmentFeedbackMarkingClosing }}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!--========== End Basic Description ==========-->
                </div>
            </div>
            <!--=========== End Main class ===============-->
        </section>
    </div>
</template>

<script>
import assignmentInfoMixin from "../../mixins/assignmentInfoMixin";
import config from "../../../../config";
import axios from "axios";

export default {
    name: "view-assignment-info",
    mixins: [assignmentInfoMixin],
    data() {
        return {
            unit: '',
            unitCode: '',
            title: '',
            learningOutcome: '',
            scenario: '',
            base: '',
            topicSelection:'',
            assignmentSubmission:'',
            assignmentSubmissionClosing:'',
            assignmentMarkingOpening:'',
            assignmentMarkingClosing:'',
            assignmentFeedbackMarkingOpening:'',
            assignmentFeedbackMarkingClosing:'',
        }
    },
    mounted() {
        this.getBasicAssignmentInfo()
        this.loadAssignmentDeadlineData()
    },
    methods: {
        getBasicAssignmentInfo() {
            this.base = config.BASE_URL
            let endpoint = config.BASE_URL + "api/assignment/" + this.assignmentId + "/info"

            axios.get(endpoint, {
                headers: {
                    'token': localStorage.token
                }
            }).then((response) => {
                this.unit = response.data.unit
                this.unitCode = response.data.unitCode
                this.title = response.data.title
                this.learningOutcome = response.data.learningOutcome
                this.scenario = response.data.scenario
                this.initialData = response.data
            })
        },
        loadAssignmentDeadlineData() {
            let endpoint = this.base + "api/assignment/" + this.assignmentId  + "/deadline"

            axios.get(endpoint, {
                headers: {
                    'token': localStorage.token
                }
            }).then((response) => {
                this.topicSelection = response.data.topicSelection
                this.assignmentSubmission = response.data.assignmentSubmission
                this.assignmentSubmissionClosing = response.data.assignmentSubmissionClosing
                this.assignmentMarkingOpening = response.data.assignmentMarkingOpening
                this.assignmentMarkingClosing = response.data.assignmentMarkingClosing
                this.assignmentFeedbackMarkingOpening = response.data.assignmentFeedbackMarkingOpening
                this.assignmentFeedbackMarkingClosing = response.data.assignmentFeedbackMarkingClosing
            })
        },
    }
}
</script>

<style scoped>

</style>
