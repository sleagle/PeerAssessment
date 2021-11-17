<template>
  <div>
    <nav-bar
        v-bind:redirectLoc="'/lecturer/'">
    </nav-bar>

    <assignment-info-side-bar v-bind:assignmentId="assignmentId" v-bind:current-view="currentView">

    </assignment-info-side-bar>
    <div class="main">
     <div class="container box mx-auto" style="width: 90%; margin-top: 100px;  height: auto;">
      <assignment-info-breadcrumb v-bind:unit-code="unitCode" v-bind:current-breadcrumb="currentBreadcrumb">

      </assignment-info-breadcrumb>
      <div class="section" style="height: 60%;">
        <div class="container">
          <h4 style="font-family: 'Noto Serif', serif; color: #274F73; margin-left: 18px; margin-top: 20px;">Submission Deadlines</h4>
          <br>
          <div class="form-left-padding">
            <div class="form-group row pl-5">
              <label for="topicSelectionDeadLine" class="col-sm-4 col-form-label">Topic Selection Closing Date:</label>
              <div class="col-sm-4">
                <input type="datetime-local" class="form-control" id="topicSelectionDeadLine"
                       v-model="topicSelection">
              </div>
            </div>
            <div class="form-group row pl-5">
              <label for="assignmentSubmissionDeadLine" class="col-sm-4 col-form-label">Assignment Submission Deadline:</label>
              <div class="col-sm-4">
                <input type="datetime-local" class="form-control" id="assignmentSubmissionDeadLine"
                       v-model="assignmentSubmission">
              </div>
            </div>
            <div class="form-group row pl-5">
              <label for="assignmentSubmissionClosingLine" class="col-sm-4 col-form-label">Assignment Submission Closing Date:</label>
              <div class="col-sm-4">
                <input type="datetime-local" class="form-control" id="assignmentSubmissionClosingLine"
                       v-model="assignmentSubmissionClosing">
              </div>
            </div>
            <div class="form-group row pl-5">
              <label for="assignmentMarkingOpeningDate" class="col-sm-4 col-form-label">Assignment Marking Opening Date:</label>
              <div class="col-sm-4">
                <input type="datetime-local" class="form-control" id="assignmentMarkingOpeningDate"
                       v-model="assignmentMarkingOpening">
              </div>
            </div>
            <div class="form-group row pl-5">
              <label for="assignmentMarkingClosingDate" class="col-sm-4 col-form-label">Assignment Marking Closing Date:</label>
              <div class="col-sm-4">
                <input type="datetime-local" class="form-control" id="assignmentMarkingClosingDate"
                       v-model="assignmentMarkingClosing">
              </div>
            </div>
            <div class="form-group row pl-5">
              <label for="feedbackMarkingOpeningDate" class="col-sm-4 col-form-label">Feedback Marking Opening Date:</label>
              <div class="col-sm-4">
                <input type="datetime-local" class="form-control" id="feedbackMarkingOpeningDate"
                       v-model="assignmentFeedbackMarkingOpening">
              </div>
            </div>
            <div class="form-group row pl-5">
              <label for="feedbackMarkingClosingDate" class="col-sm-4 col-form-label">Feedback Marking Closing Date:</label>
              <div class="col-sm-4">
                <input type="datetime-local" class="form-control" id="feedbackMarkingClosingDate"
                       v-model="assignmentFeedbackMarkingClosing">
              </div>
            </div>
            <div class="form-group row pl-3">
              <div class="col-sm-4"></div>
              <div class="col-sm-4 text-right">
                <div class="container text-right fadeIn animated" style="margin-top: 20px; padding-right: 40px;">
                  <button type="button" class="btn-pas zoom" @click="resetForm">Reset</button>
                  <button type="button" class="btn-pas zoom" @click="updateInfo">Update</button>
                </div>
              </div>
            </div>
            <update-assignment-details-success>

            </update-assignment-details-success>
          </div>
        </div>
      </div>
     </div>
    </div>
  </div>
</template>

<script>
import assignmentInfoMixin from "../mixins/assignmentInfoMixin";
import config from "../../../config";
import axios from "axios";
import moment from "moment";
import updateSuccessMixin from "../mixins/updateSuccessMixin";

export default {
  name: "assignment-info-deadline",
  mixins: [assignmentInfoMixin, updateSuccessMixin],
  data() {
    return {
      unitCode: '',
      topicSelection:'',
      assignmentSubmission:'',
      assignmentSubmissionClosing:'',
      assignmentMarkingOpening:'',
      assignmentMarkingClosing:'',
      assignmentFeedbackMarkingOpening:'',
      assignmentFeedbackMarkingClosing:'',
      initial: {},
      base: ''
    }
  },
  mounted() {
    this.loadAssignmentDeadlineData()
  },
  methods: {
    loadAssignmentDeadlineData() {
      this.base = config.BASE_URL
      let endpoint = config.BASE_URL + "api/assignment/" + this.assignmentId  + "/deadline"

      axios.get(endpoint, {
        headers: {
          'token': localStorage.token
        }
      }).then((response) => {
        this.unitCode = response.data.unitCode
        this.topicSelection = this.formatDate(response.data.topicSelection);
        this.assignmentSubmission = this.formatDate(response.data.assignmentSubmission)
        this.assignmentSubmissionClosing = this.formatDate(response.data.assignmentSubmissionClosing)
        this.assignmentMarkingOpening = this.formatDate(response.data.assignmentMarkingOpening)
        this.assignmentMarkingClosing = this.formatDate(response.data.assignmentMarkingClosing)
        this.assignmentFeedbackMarkingOpening = this.formatDate(response.data.assignmentFeedbackMarkingOpening)
        this.assignmentFeedbackMarkingClosing = this.formatDate(response.data.assignmentFeedbackMarkingClosing)
        this.initial = response.data
      })
    },
    formatDate(date) {
      return moment(date).format().split('+')[0]
    },
    resetForm() {
      this.topicSelection = this.formatDate(this.initial.topicSelection);
      this.assignmentSubmission = this.formatDate(this.initial.assignmentSubmission)
      this.assignmentSubmissionClosing = this.formatDate(this.initial.assignmentSubmissionClosing)
      this.assignmentMarkingOpening = this.formatDate(this.initial.assignmentMarkingOpening)
      this.assignmentMarkingClosing = this.formatDate(this.initial.assignmentMarkingClosing)
      this.assignmentFeedbackMarkingOpening = this.formatDate(this.initial.assignmentFeedbackMarkingOpening)
      this.assignmentFeedbackMarkingClosing = this.formatDate(this.initial.assignmentFeedbackMarkingClosing)
    },
    updateInfo() {
      let endpoint = this.base + "api/assignment/" + this.assignmentId  + "/update/deadline"
      let config =
          {
            headers: {
              'token': localStorage.token
            }
          }

      axios.post(endpoint, {
        deadline: {
          topicSelection: this.topicSelection,
          assignmentSubmission: this.assignmentSubmission,
          assignmentSubmissionClosing: this.assignmentSubmissionClosing,
          assignmentMarkingOpens: this.assignmentMarkingOpening,
          assignmentMarkingEnds: this.assignmentMarkingClosing,
          feedbackMarkingOpens: this.assignmentFeedbackMarkingOpening,
          feedbackMarkingEnds: this.assignmentFeedbackMarkingClosing
        }
      }, config)
          .then((response) => {
            if (response.data > 0) {
              updateSuccessMixin.methods.showAssignmentUpdateModel()
            }
          })
          .catch((error) => {
            console.log(error)
          });
    }
  }
}
</script>

<style scoped>

</style>
