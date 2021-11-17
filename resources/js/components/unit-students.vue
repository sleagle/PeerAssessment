<template>
  <div>
    <nav-bar
        v-bind:redirectLoc="'/lecturer/'">

    </nav-bar>
    <div class="container box mx-auto" style="margin-top: 100px; width:80%;">
    <div class="container">
      <div class="row" style="padding: 5px;">
        <div class="col">
          <a href="/lecturer/" style="color: #274F73">LECTURER HOME / </a>
          <a href="/lecturer/manage-students" style="color: #274F73"> &nbsp MANAGE STUDENTS /</a>
          <a href="#" style="color: #ff7350;">&nbsp {{unitCode}}</a>
        </div>
      </div>
    </div>
    <div class="container section">
      <!--=========== Main class ===============-->
      <div class="student-list-main">
        <div class="row ml-2">
          <div class="col-sm-4 mt-2">
            <label for="sortSelect">Sort by:</label>
            <select id="sortSelect" v-model="sortBy">
              <option value="0">--Select--</option>
              <option value="1">First name</option>
              <option value="2">Last name</option>
              <option value="3">Username</option>
              <option value="4">ID</option>
            </select>
          </div>
          <div class="col-sm-4">
            <form class="form-inline mr-auto" target="_self">
              <div class="form-group">
                <label>Search: &nbsp</label>
                <label for="search-field"><i class="fa fa-search" style="color: rgb(53, 53, 53);"></i></label>
                <input class="form-control search-field" v-model="searchQuery" id="search-field" name="search"
                       style="border: none; color: rgb(53, 53, 53); text-decoration: underline;">
              </div>
            </form>
          </div>
        </div>

        <div class="row ml-4 my-2">
          <div style="padding-bottom: 10px;">
              <input type="file" @change="onFileSelected">
          </div>
          <div style="padding-bottom: 10px;">
            <input type="button" class="btn-pas zoom" value="Upload & Enrol" @click="uploadFile">
            <span style="padding-right: 10px;"></span>
          </div>
          <form style="padding-bottom: 10px;" action="/files/student_upload_template.csv" method="get">
            <input type="submit" class="btn-sm bg-light" value="Download Template"> <span style="padding-right: 10px;"></span>
          </form>
          <div style="padding-bottom: 10px;">
            <input type="button" class="btn-sm bg-light" value="Export to .CSV"> <span style="padding-right: 10px;"></span>
          </div>
          <div style="padding-bottom: 10px;">
            <input type="button" class="btn-pas zoom" value="Delete all students"><span style="padding-right: 10px;"></span>
          </div>
          <div style="padding-bottom: 10px;">
            <input type="button" class="btn-pas zoom" value="Add new student" data-toggle="modal"
                   data-target="#addStudentsModal"><span style="padding-right: 10px;"></span>
          </div>
          <div style="padding-bottom: 10px;">
            <input type="button" class="btn-pas zoom" value="Save" @click="uploadFile">
          </div>
        </div>

        <!--============ Table ===========-->
        <div class="pl-1" style="overflow:auto; height:600px;">

          <table class="table  " style="font-size:80% ;table-layout:fixed; width:100%;" cellspacing="0">
            <thead>
            <tr style="text-align: center;">
              <th style="width: 30px;">#</th>
              <th style="width: 100px;">First name</th>
              <th style="width: 100px;">Last name</th>
              <th style="width: 100px;">Username</th>
              <th style="width: 80px;">Student ID</th>
              <th style="width: 50px;">Enable</th>
            </tr>
            </thead>
            <tbody>
            </tbody>
          </table>
          <div style="overflow:auto; height:500px; margin-top: -16px;" id="table-mark">

            <table class="table table-bordered"
                   style="font-size:80% ;table-layout:fixed; width:100%; border-top: none;" cellspacing="0">
              <tbody>
                <tr style="text-align: center;" v-for="student in sortedArray">
                  <td style="width: 30px;">{{student.rowNum}}</td>
                  <td style="width: 100px;">{{student.firstName}}</td>
                  <td style="width: 100px;">{{student.lastName}}</td>
                  <td style="width: 100px;">{{student.username}}</td>
                  <td style="width: 80px;">{{student.studentId}}</td>
                  <td style="width: 50px;"><input type="checkbox" checked></td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
        <!--============= End table ==========-->
      </div>

      <!--======== Modal for adding student ==========-->
      <div class="modal fade" id="addStudentsModal" tabindex="-1" role="dialog"
           aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Adding Students</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form class="form-left-padding">

                <div class="form-group row">
                  <label for="fname" class="col-sm-2 col-form-label">Firstname</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="fname" placeholder="First name">
                  </div>
                </div>

                <div class="form-group row">
                  <label for="lname" class="col-sm-2 col-form-label">Lastname</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="lname" placeholder="Last name">
                  </div>
                </div>
                <div class="form-group row">
                  <label for="username" class="col-sm-2 col-form-label">Username</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="username" placeholder="Username">
                  </div>
                </div>
                <div class="form-group row">
                  <label for="studentID" class="col-sm-2 col-form-label">Student ID</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="studentID" placeholder="Student ID">
                  </div>
                </div>
                <div class="form-group row">
                  <label for="enable" class="col-sm-2 col-form-label">Enabled</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="enable" placeholder="Status">
                  </div>
                </div>

              </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-success" onclick="studentSaveModal()">Save changes</button>
            </div>
          </div>
        </div>
      </div>
      <!--======== End Modal for adding student ==========-->
      <!--=========== End Main class ===============-->
    </div>
    </div>
  </div>
</template>

<script>
  import routeDetailsMixin from "../mixins/routeDetailsMixin";
  import config from "../../../config";
  import axios from "axios";
  import _ from 'lodash';

  export default {
    name: "unit-students",
    mixins: [routeDetailsMixin],
    data() {
      return {
        studentsList: [],
        selectedFile: null,
        sortBy: "0",
        searchBy: '',
        searchQuery: '',
        searchQueryIsDirty: false,
      }
    },
    mounted() {
      this.getStudentsInCurrentEnrollment()
    },
    computed: {
      sortedArray() {
        if (this.searchQuery !== '') {
          return this.studentsList.filter(student => {
            return student.firstName.toLowerCase().includes(this.searchQuery.toLowerCase())
          })
        }
        if (this.sortBy === "0") {
          return this.studentsList
        }
        else if (this.sortBy === "1") {
          return _.orderBy(this.studentsList, 'firstName')
        }
        else if (this.sortBy === "2") {
          return _.orderBy(this.studentsList, 'lastName')
        }
        else if (this.sortBy === "3") {
          return _.orderBy(this.studentsList, 'username')
        }
        else if (this.sortBy === "4") {
          return _.orderBy(this.studentsList, 'studentId')
        }
      }
    },
    watch: {
      searchQuery: function () {
        this.searchQueryIsDirty = true
        this.expensiveOperation()
      }
    },
    methods: {
      onFileSelected(event) {
        this.selectedFile = event.target.files[0]
      },
      uploadFile() {
        let endpoint = config.BASE_URL + "api/file/students-to-unit"
        const formData = new FormData();
        formData.append('studentList', this.selectedFile)
        formData.append('unitCode', this.unitCode)

        axios.post(endpoint, formData, {
          headers: {
            'Content-Type': 'multipart/form-data',
            'token': localStorage.token
          }
        }).then((response) => {
          this.studentsList = response.data
        })
      },
      getStudentsInCurrentEnrollment() {
        let endpoint = config.BASE_URL + "api/unit/students/"+this.unitCode

        axios.get(endpoint, {
          headers: {
            'token': localStorage.token
          }
        }).then((response) => {
          this.studentsList = response.data
        })
      },
      expensiveOperation: _.debounce(function () {
        setTimeout(function () {
          this.searchQueryIsDirty = false
        }.bind(this), 1000)
      }, 500)
    }
  }
</script>

<style scoped>

</style>
