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
    <!--======== Marking Criteria ===========-->

    <div class="section">
      <div class="container">
        <br>
        <h4 style="font-family: 'Noto Serif', serif; color: #274F73; margin-left: 18px;">Marking Criteria</h4>
        <br>

        <!-- Assignment Marking Criteria-->
        <h5 style="margin-left: 20px;"><strong>1. Assignment marking criteria </strong></h5>
        <div class="row pl-5">
          <div class="col-8 d-flex ml-3">
            <div class="form-group row ml-1">
              <label style="margin-right: 5px;">Upload Excel File: </label>
              <form action="">
                <input type="file" id="myFile" name="filename">
              </form>
            </div>
          </div>
          <div class="col-3">
              <input type="button" class="btn-sm bg-light mt-2" value="Download Template"/>
          </div>
        </div>

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
          <div>
            <!--======= Add marking criteria Modal ========-->
            <assignment-criteria @clicked="addMarkingCriteria">

            </assignment-criteria>
            <!--======= End Add marking criteria Modal ========-->

            <input type="button" class="btn-pas zoom" value="Add New Marking Criteria"
                   data-toggle="modal" data-target="#addCriteriaModal">
          </div>
        </div>

        <br><br>
        <!-- Assignment Feedback Criteria-->
        <h5 style="margin-left: 20px;"><strong>2. Feedback marking criteria</strong> </h5>
        <div class="row pl-5">
          <div class="col-8 d-flex ml-3">
            <div class="form-group row ml-1">
              <label style="margin-right: 5px;">Upload Excel File: </label>
              <form action="">
                <input type="file" id="myFile" name="filename">
              </form>
            </div>
          </div>
          <div class="col-3">
              <input type="button" class="btn-sm bg-light mt-2" value="Download Template" />
          </div>
        </div>

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
          <div>
            <!--========== Add Feedback Criteria Modal ===========-->
            <feedback-criteria @clicked="addFeedbackCriteria">

            </feedback-criteria>
            <!--========== End Add Feedback Criteria Modal ===========-->

            <input type="button" class="btn-pas zoom" value="Add New Marking Criteria"
                   data-toggle="modal" data-target="#addFeedbackCriteriaModal">
          </div>
        </div>
        <div style="text-align: right; margin-top: 20px; margin-right: 20px;">
          <button type="button" class="btn-pas zoom" data-toggle="modal" data-target="#saveChanges">Save</button>
        </div>
        <br>
      </div>
      <!-- End Assignment Feedback Criteria-->

      <!-- Modal -->
      <div class="modal fade" id="saveChanges" role="dialog">
        <div class="modal-dialog">

          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Notification</h4>
              <button type="button" class="close" data-dismiss="modal" style="color: red;">&times;</button>
            </div>
            <div class="modal-body">
              <p>You have saved changes successfully!.</p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-success" data-dismiss="modal">Done</button>
            </div>
          </div>

        </div>
      </div>


      <!--======== End Button ==========-->
    </div>
    <!--======== End Marking Criteria ===========-->
    </div>
  </div>
  </div>
</template>

<script>
import assignmentInfoMixin from "../mixins/assignmentInfoMixin";
import config from "../../../config";
import axios from "axios";

export default {
  name: "assignment-info-marking-scheme",
  mixins: [assignmentInfoMixin],
  data() {
    return {
      unitCode: '',
      markingCriteria: [],
      feedbackCriteria: [],
      initial : {}
    }
  },
  mounted() {
    this.loadAssignmentCriteriaData()
  },
  methods: {
    loadAssignmentCriteriaData() {
      let endpoint = config.BASE_URL + "api/assignment/" + this.assignmentId  + "/marking-criteria"

      axios.get(endpoint, {
        headers: {
          'token': localStorage.token
        }
      }).then((response) => {
        this.unitCode = response.data.unitCode
        this.markingCriteria = response.data.markingCriteria
        this.feedbackCriteria = response.data.feedbackCriteria
        this.initial = response.data
      })
    },
    addMarkingCriteria(markingCriteria) {
      this.markingCriteria.push(markingCriteria)
      console.log(markingCriteria)
    },
    addFeedbackCriteria(feedbackCriteria) {
      this.feedbackCriteria.push(feedbackCriteria)
    }
  }
}
</script>

<style scoped>

</style>
