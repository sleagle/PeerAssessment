<template>
  <div>
    <nav-bar
        v-bind:redirectLoc="'/lecturer/'">

    </nav-bar>
    <assignment-info-side-bar v-bind:assignmentId="assignmentId" v-bind:current-view="currentView">

    </assignment-info-side-bar>
    <div class="main">
      <div class="container box mx-auto" style="width: 90%; margin-top: 100px;">
      <assignment-info-breadcrumb v-bind:unit-code="unitCode" v-bind:current-breadcrumb="currentBreadcrumb">

      </assignment-info-breadcrumb>
      <!--====Basic Description=======-->
      <div class="section fadeIn animated">
        <div class="container">
          <h4 style="font-family: 'Noto Serif', serif; color: #274F73; margin-top:20px; margin-left: 18px; padding-bottom: 20px;">Basic Information</h4>
          <label for="unitCode" style="text-align: left;"><strong style="color: red; margin-left: 20px;">*</strong></label><label>Unit</label> <br>
          <input id="unitCode" style="width: 95%; margin-left: 20px;" disabled v-model="unit"/>
          <br><br>
          <label for="title"><strong style="color: red; margin-left: 20px;text-align: left;">*</strong></label> <label>Assignment Title</label>
          <br>
          <input class="form-control" type="text" style="width: 95%; border: 1px solid #6a6a6a; margin-left: 20px;"  id="title" placeholder="Assignment 1" v-model="title">
          <br><br>
          <label for="learningOutcome" style="margin-left: 20px;text-align: left;">Learning Outcomes</label>
          <br>
          <textarea class="form-control" row="10" style="width: 95%; border: 1px solid #6a6a6a; margin-left: 20px;"  id="learningOutcome" v-model="learningOutcome"></textarea>
          <br><br>
          <label for="scenario" style="margin-left: 20px;text-align: left;">Scenario</label>
          <br>
          <textarea class="form-control" row="10" id="scenario" style="width: 95%; border: 1px solid #6a6a6a; margin-left: 20px;;" v-model="scenario"></textarea>
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
</template>

<script>
  import config from "../../../config";
  import axios from "axios";
  import AddTopic from "./add-topic";
  import assignmentInfoMixin from "../mixins/assignmentInfoMixin";
  import updateSuccessMixin from "../mixins/updateSuccessMixin";

  export default {
    name: "assignment-info-basic",
    components: {AddTopic},
    mixins: [assignmentInfoMixin, updateSuccessMixin],
    data() {
      return {
        unit: '',
        unitCode: '',
        title: '',
        learningOutcome: '',
        scenario: '',
        initialData: {},
        base: '',
      }
    },
    mounted() {
      this.getBasicAssignmentInfo()
    },
    methods: {
      getBasicAssignmentInfo()  {
        this.base = config.BASE_URL
        let endpoint = config.BASE_URL + "api/assignment/" + this.assignmentId  + "/info"

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
      resetForm() {
        this.title = this.initialData.title
        this.learningOutcome = this.initialData.learningOutcome
        this.scenario = this.initialData.scenario
      },
      updateInfo() {
        let endpoint = this.base + "api/assignment/" + this.assignmentId  + "/update/info"
        let config =
            {
              headers: {
                'token': localStorage.token
              }
            }

        axios.post(endpoint, {
          title: this.title,
          learningOutcome: this.learningOutcome,
          scenario: this.scenario
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
