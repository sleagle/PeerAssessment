<template>
  <div>
    <nav-bar
        v-bind:redirectLoc="'/lecturer/'">

    </nav-bar>
    <assignment-info-side-bar v-bind:assignmentId="assignmentId" v-bind:current-view="currentView">

    </assignment-info-side-bar>
    <div class="main">
     <div class="container box mx-auto" style="width: 90%; margin-top: 100px; height: auto;">
      <assignment-info-breadcrumb v-bind:unit-code="unitCode" v-bind:current-breadcrumb="currentBreadcrumb">

      </assignment-info-breadcrumb>
      <div class="section">
          <div class="container">
          <h4 style="font-family: 'Noto Serif', serif; color: #274F73; margin-top:20px; margin-left: 18px;">Topics Specification</h4>
          <!--Form-->
          <div class="custom-control custom-checkbox mb-3 ml-3">
            <input type="checkbox" class="custom-control-input" id="singleTopicCheck" :disabled="topicSpecification.length > 0"
                   onclick="hideTable(this, 'checked', 'unChecked')">
            <label class="custom-control-label" for="singleTopicCheck">Single Topic</label>
          </div>

          <!-- Checked -->
          <div id="checked">
            <div class="form-group row" style="margin-left: 15px;">
                <div class="col-6 d-flex ml-3">
                    <label style="margin-right: 5px;">Upload CSV File: </label>
                    <input type="file"  @change="onFileSelected">
                </div>
                <div class="col-2">
                    <input type="button" class="btn-pas zoom" value="Upload & Add" @click="uploadFile">
                </div>
                <div class="col-2">
                    <form action="/files/add_topics_template.csv" method="get">
                        <input type="submit" class="btn-sm bg-light" value="Download Template">
                    </form>
                </div>

            </div>

            <div id="mainTable" class="col-sm-12">
              <table class="table table-bordered">
                <thead>
                <tr>
                  <th scope="col" width="15%" style="text-align: center;">Item ID</th>
                  <th scope="col" width="65%" style="text-align: center;">Topic Title</th>
                  <th scope="col" width="20%" style="text-align: center;">Number of Students</th>
                </tr>
                </thead>
                <tbody>
                  <tr v-for="topic in topicSpecification">
                    <td align="center">{{ topic.rowNum }}</td>
                    <td align="let">{{ topic.title }}</td>
                    <td align="center">{{ topic.numStudents }}</td>
                  </tr>
                </tbody>
              </table>
            </div>

            <!--======= Add topic modal ======-->
            <add-topic @clicked="addTopicToAssignment" v-bind:count="topicSpecification.length">

            </add-topic>

            <div class="text-right pr-3">
              <input type="button" class="btn-sm add-btn zoom" value="Add New Topic"
                     data-toggle="modal" data-target="#addTopicModal"/>
              <button class="btn-pas zoom ml-2 mt-2" @click="resetForm">Reset</button>
              <button class="btn-pas zoom ml-2 mt-2" @click="updateTopics">Update</button>
            </div>
          </div>
        </div>
      </div>
     </div>
    </div>
  </div>
</template>

<script>
import config from "../../../config";
import axios from "axios";
import assignmentInfoMixin from "../mixins/assignmentInfoMixin";

export default {
  name: "assignment-info-topic",
  mixins: [assignmentInfoMixin],
  data() {
    return {
      base: '',
      selectedFile: null,
      unitCode: '',
      topicSpecification: [],
      newTopics: [],
    }
  },
  mounted() {
    this.getAssignmentTopics()
  },
  methods: {
    onFileSelected(event) {
      this.selectedFile = event.target.files[0]
    },
    uploadFile() {
      let endpoint = this.base + "api/file/topics-to-assignment"
      const formData = new FormData();
      formData.append('topicList', this.selectedFile)
      formData.append('assignmentId', this.assignmentId)

      axios.post(endpoint, formData, {
        headers: {
          'Content-Type': 'multipart/form-data',
          'token': localStorage.token
        }
      }).then((response) => {
        this.topicSpecification = response.data.topics
      })
    },
    getAssignmentTopics() {
      this.base = config.BASE_URL;
      let endpoint = config.BASE_URL + "api/assignment/" + this.assignmentId  + "/topics"

      axios.get(endpoint, {
        headers: {
          'token': localStorage.token
        }
      }).then((response) => {
        this.unitCode = response.data.unitCode
        this.topicSpecification = response.data.topics
      })
    },
    addTopicToAssignment(topic) {
      this.topicSpecification.push(topic)
      this.newTopics.push(topic)
    },
    resetForm() {
      this.topicSpecification = this.topicSpecification.filter(x => !this.newTopics.includes(x))
    },
    updateTopics() {
      let endpoint = this.base + "api/assignment/" + this.assignmentId  + "/update/topics"

      axios.post(endpoint, {
        "topicSpecification" : this.newTopics
      }, {
        headers: {
          'token': localStorage.token
        }
      }).then((response) => {
        this.topicSpecification = response.data.topics
      })
    }
  }
}
</script>

<style scoped>

</style>
