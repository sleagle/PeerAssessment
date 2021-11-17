<template>
    <div>
        <nav-bar
            v-bind:redirectLoc="'/student/'">

        </nav-bar>
        <section id="main" style="height: 100vh;">
            <view-assignment-sidebar v-bind:assignment-id="assignmentId" v-bind:current-view="currentView">

            </view-assignment-sidebar>

            <div class="main">
                <div class="container box mx-auto" style="width: 90%; margin-top: 100px;">
                <div class="row d-flex pl-4" style="margin-top: 10px;">
                    <a style="color: #274F73;" href="/student/">HOME /</a>
                    <a style="color: #274F73;" :href="'/student/assignments?unit='+unitCode">&nbsp {{ unitCode }} /</a>
                    <a style="color: #ff7350;" href="#">&nbsp TOPIC SELECTION</a>
                </div>
                <!--======== Marking Criteria ===========-->

                <div class="section">
                    <div class="container fadeIn animated">
                        <br>
                        <h4 style="font-family: 'Noto Serif', serif; color: #274F73;">Topic Selection</h4>
                        <br><br>
                        <!--Table for selecting topic -->
                        <div id="" class="col-sm-12">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th scope="col" width="10%" class="text-center" style="font-size: 14px;">#</th>
                                    <th scope="col" width="50%" class="text-center" style="font-size: 14px;">Topic title</th>
                                    <th scope="col" width="20%" class="text-center" style="font-size: 14px;">Students allowed</th>
                                    <th scope="col" width="20%" class="text-center" style="font-size: 14px;">Join / Leave group</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="topic in topics">
                                        <td align='center'>{{ topic.rowNum }}</td>
                                        <td>{{ topic.title }}</td>
                                        <td align='center'>{{ topic.numSelected }}/{{ topic.numStudents }}</td>
                                        <td align='center'>
                                            <div class="btn btn-sm btn-info">Join</div> / <div class="btn btn-sm btn-info">Leave</div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
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
    name: "view-assignment-topics",
    mixins: [assignmentInfoMixin],
    data() {
        return {
            unitCode: '',
            topics: []
        }
    },
    mounted() {
        this.loadAssignmentTopics()
    },
    methods: {
        loadAssignmentTopics() {
            let endpoint = config.BASE_URL + "api/assignment/" + this.assignmentId + "/topics"

            axios.get(endpoint, {
                headers: {
                    'token': localStorage.token
                }
            }).then((response) => {
                this.unitCode = response.data.unitCode
                this.topics = response.data.topics
            })
        }
    }
}
</script>

<style scoped>

</style>
