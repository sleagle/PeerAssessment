<template>
  <div>
    <nav-bar
        v-bind:redirectLoc="'/lecturer/'">

    </nav-bar>
    <assignment-info-side-bar v-bind:assignmentId="assignmentId" v-bind:current-view="currentView">

    </assignment-info-side-bar>
    <div class="main" style="height: 100vh;">
     <div class="container box mx-auto" style="width: 90%; margin-top: 100px;  height: auto;">
      <assignment-info-breadcrumb v-bind:unit-code="unitCode" v-bind:current-breadcrumb="currentBreadcrumb">

      </assignment-info-breadcrumb>

      <div class="section">
        <div class="container">
          <h4 style="font-family: 'Noto Serif', serif; color: #274F73; margin-left: 18px; margin-top:20px;">Peers Allocation</h4>
          <br><br>
          <div class="row pl-5">
            <div class="col">
              <div class="form-group row ml-1">
                <label for="peersNumber">Peers for assessment</label>
                <span style="padding-left: 10px"></span>
                <input id="peersNumber" type="number" name="peersNumber" class="col-sm-2"v-model="numOfReviews"/>
              </div>
            </div>
          </div>
          <br>
          <div class="row ml-sm-1 pl-5">
            <label for="allocationMethod">Review Allocation</label>
            <span style="padding-left: 10px"></span>
            <select id="allocationMethod" v-model="allocationStrategy">
              <option value="2">Random (with different topics)</option>
              <option value="1">Random (with same topic)</option>
              <option value="0">Manually (upload a .csv file)</option>
            </select>
          </div>
          <div style="text-align: right; margin-top: 20px; padding-right: 120px;">
            <button type="button" class="btn-pas zoom" @click="allocatePeers">Allocate</button>
            <button type="button" class="btn-pas zoom" @click="updateChanges">Save</button>
          </div>
        </div>
        <update-assignment-details-success>

        </update-assignment-details-success>
      </div>
     </div>
    </div>
  </div>
</template>

<script>
import assignmentInfoMixin from "../mixins/assignmentInfoMixin";
import config from "../../../config";
import axios from "axios";
import updateSuccessMixin from "../mixins/updateSuccessMixin";

export default {
  name: "assignment-info-peer-allocation",
  mixins: [assignmentInfoMixin, updateSuccessMixin],
  data() {
    return {
      unitCode: "",
      numOfReviews: 0,
      allocationStrategy: 0,
      base: ''
    }
  },
  mounted() {
    this.getUnitFromAssignment()
  },
  methods: {
    getUnitFromAssignment() {
      this.base = config.BASE_URL
      let endpoint = config.BASE_URL + "api/assignment/" + this.assignmentId  + "/peers"

      axios.get(endpoint, {
        headers: {
          'token': localStorage.token
        }
      }).then((response) => {
        this.unitCode = response.data.unitCode
        this.numOfReviews = response.data.numPeers
        this.allocationStrategy = response.data.allocationStrategy
      })
    },
    allocatePeers() {
      let endpoint = this.base + "api/assignment/" + this.assignmentId  + "/assign-peers"
    },
    updateChanges() {
      let endpoint = this.base + "api/assignment/" + this.assignmentId  + "/update/peers"
    }
  }
}
</script>

<style scoped>

</style>
