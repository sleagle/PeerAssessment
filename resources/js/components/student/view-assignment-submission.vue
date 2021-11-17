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
                    <a style="color: #ff7350;" href="#">&nbsp SUBMISSION</a>
                </div>
                <!--======== Marking Criteria ===========-->
                <div class="section">
                    <div class="container fadeIn animated">
                        <br>
                        <h4 style="font-family: 'Noto Serif', serif; color: #274F73;">Assignments Submission</h4>
                        <p class="text-danger">Please, submit a .pdf file!</p>
                        <br><br>
                        <!--Submission section-->
                        <form class="dropzone" method="post" enctype="multipart/form-data">
                            <div class="fallback">
                                <input name="file" type="file" ref="file" multiple v-on:change="handleFileUpload" />
                            </div>
                        </form>
                        <!--End Submission section-->
                        <br>
                        <button type="button" class="btn-pas zoom" v-on:click="submitAssignment">Submit</button>
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
    name: "view-assignment-submission",
    mixins: [assignmentInfoMixin],
    data() {
        return {
            unitCode: '',
            file: '',
        }
    },
    mounted() {
        this.loadAssignmentTopics()
    },
    methods: {
        loadAssignmentTopics() {
            let endpoint = config.BASE_URL + "api/assignment/" + this.assignmentId + "/info"

            axios.get(endpoint, {
                headers: {
                    'token': localStorage.token
                }
            }).then((response) => {
                this.unitCode = response.data.unitCode
            })
        },
        handleFileUpload() {
            this.file = this.$refs.file.files[0]
        },
        submitAssignment() {

            let endpoint = config.BASE_URL + "api/file/assignment-upload"
            let formData = new FormData()
            formData.append('uploadedFile', this.file)
            formData.append('assignmentId', this.assignmentId)

            axios.post(endpoint,formData,{
                headers: {
                    'Content-Type': 'multipart/form-data',
                    'token': localStorage.token
                }
            }).then((response) => {
                window.location = "/student/assignments?unit="+this.unitCode
            });
        }
    }
}
</script>

<style scoped>

</style>
