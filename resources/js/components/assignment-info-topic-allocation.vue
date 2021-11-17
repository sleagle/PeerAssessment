<template>
  <div>
    <nav-bar
        v-bind:redirectLoc="'/lecturer/'">

    </nav-bar>
    <assignment-info-side-bar v-bind:assignmentId="assignmentId" v-bind:current-view="currentView">

    </assignment-info-side-bar>
    <div class="main">
     <div class="container box mx-auto" style="width: 90%; margin-top: 100px;  height:auto;">
      <assignment-info-breadcrumb v-bind:unit-code="unitCode" v-bind:current-breadcrumb="currentBreadcrumb">

      </assignment-info-breadcrumb>

      <div class="section" style="height: auto;">
        <div class="container">
          <br>
          <h4 style="font-family: 'Noto Serif', serif; color: #274F73; margin-left: 15px;">Allocation of topics</h4>
          <br>
          <div class="form-group row" style="margin-left: 15px;">
            <!-- <div class="col-8 d-flex"> -->
            <label style="margin-right: 5px;">Upload CSV File: </label>
            <form action="">
              <input type="file" id="myFile" name="filename">
            </form>
            <input type="button" class="btn-sm bg-light mt-2" value="Download Template" />
          </div>

          <div class="col-sm-12">
            <table class="table table-bordered">
              <thead>
              <tr>
                <th scope="col" width="10%" style="text-align: center;">Item ID</th>
                <th scope="col" width="25%" style="text-align: center;">Student Name &nbsp &nbsp<input type="checkbox"></th>
                <th scope="col" width="15%" style="text-align: center;">Student ID  &nbsp&nbsp <input type="checkbox"></th>
                <th scope="col" width="40%" style="text-align: center;">Topic Title  &nbsp&nbsp <input type="checkbox"></th>
                <th scope="col" width="10%" style="text-align: center;">Topic selected</th>
              </tr>
              </thead>
              <tbody>
                <tr v-for="topic in topicAllocation">
                  <td scope="col" width="10%" style="text-align: center;">{{ topic.rowNum }}</td>
                  <td scope="col" width="25%" style="text-align: center;">{{ topic.studentName }}</td>
                  <td scope="col" width="15%" style="text-align: center;">{{ topic.studentId }}</td>
                  <td scope="col" width="40%" style="text-align: center;">{{ topic.topic }}</td>
                  <td scope="col" width="10%" style="text-align: center;">{{ topic.numSelected }}</td>
                </tr>
              </tbody>
            </table>
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

export default {
  name: "assignment-info-topic-allocation",
  mixins: [assignmentInfoMixin],
  data() {
    return {
      unitCode: '',
      topicAllocation: []
    }
  },
  mounted() {
    this.getTopicAllocations()
  },
  methods: {
    getTopicAllocations() {
      let endpoint = config.BASE_URL + "api/assignment/" + this.assignmentId  + "/topic-allocation"

      axios.get(endpoint, {
        headers: {
          'token': localStorage.token
        }
      }).then((response) => {
        this.unitCode = response.data.unitCode
        this.topicAllocation = response.data.topicAllocation
      })
    }
  }
}
</script>

<style scoped>

</style>
