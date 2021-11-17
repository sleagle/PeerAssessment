<template>
    <div>
        <nav-bar
            v-bind:redirectLoc="'/lecturer/'">

        </nav-bar>
        <!--==========Side navbar==========-->
        <div class="sidenav fadeIn animated" id="sidebar">
            <div class="row">
                <div class="col-md-7">
                    <a href="/lecturer/" style="margin-left: 20px; font-size: 14px;">LECTURER HOME / </a>
                </div>
                <div class="col-md-3">
                    <a href="#" class="active" style=" margin-left: -15px; font-size: 14px;">CREATE</a>
                </div>
            </div>
            <hr>
            <ul>
                <li class="item"><a class="active" href="#section1">Basic Description</a></li>
                <li class="item"><a href="#section2">Topics Specification</a></li>
                <li class="item"><a href="#section4">Marking Criteria</a></li>
                <li class="item"><a href="#section6">Peers Allocation</a></li>
                <li class="item"><a href="#section7">Submission Deadlines</a></li>
            </ul>
            <div style="padding-left: 10px; padding-right: 10px; text-align: center;">

            </div>
        </div>
        <!--==========End Side Navbar===========-->

        <!--=========== Main class ===============-->
        <div class="main">
            <div class="container box mx-auto" style="width: 90%; margin-top: 100px;">
            <!--====Basic Description=======-->
            <div id="section1" class="section fadeIn animated">
                <div class="container">
                    <br>
                    <h3 class="fadeIn animated text-center" style="font-family: 'Noto Serif', serif; color: #274F73;">
                        Create new Assignment for Students</h3>
                    <br><br>
                    <h4 style="font-family: 'Noto Serif', serif; color: #274F73">Basic Information</h4>
                    <label for="unitSelect"><strong style="color: red;">*</strong></label><label>Unit</label> <br>
                    <select style="width: 100%;" id="unitSelect">
                        <option value="0">Please select the unit</option>
                        <option v-for="unit in units" :value="unit.unitCode">{{unit.unitCode}} - {{unit.unitName}}</option>
                    </select>
                    <br><br>
                    <label><strong style="color: red;">*</strong></label> <label for="title">Assignment Title</label>
                    <br>
                    <input type="text" style="width: 100%; border: 1px solid #6a6a6a" id="title">
                    <br><br>
                    <label for="learningOutcome">Learning Outcomes</label>
                    <br>
                    <textarea style="width: 100%; border: 1px solid #6a6a6a" id="learningOutcome"></textarea>
                    <br><br>
                    <label for="scenario">Scenario</label>
                    <br>
                    <textarea style="width: 100%; border: 1px solid #6a6a6a" id="scenario"></textarea>
                </div>
            </div>
            <!--========== End Basic Description ==========-->

            <!--======== Topics Specification ===========-->
            <div id="section2" class="section">
                <div class="container">
                    <br><br>
                    <div class="row" style="border-bottom: 2px solid #FF7350;"></div>
                    <br><br>
                    <h4 style="font-family: 'Noto Serif', serif; color: #274F73">Topics Specification</h4>
                    <!--Form-->
                    <div class="custom-control custom-checkbox mb-3 ml-3">
                        <input type="checkbox" class="custom-control-input" id="singleTopicCheck"
                               onclick="hideTable(this, 'checked', 'unChecked')">
                        <label class="custom-control-label" for="singleTopicCheck">Single Topic</label>
                    </div>

                    <!-- Checked -->
                    <div id="checked">
                        <div class="form-group row">
                            <div class="col-8 d-flex ml-3">
                                <label style="margin-right: 5px;">Upload Excel File: </label>
                                <form action="">
                                    <input type="file" id="myFile" name="filename">
                                </form>
                            </div>

                            <div class="col-3">
                                <input type="button" class="btn-sm bg-light zoom" value="Download Template">
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
                            <div>
                                <!--======= Add topic modal ======-->
                                <add-topic @clicked="addTopicToAssignment" v-bind:count="topicSpecification.length">

                                </add-topic>
                                <!--======= End add topic modal ========-->
                                <input type="button" class="btn-sm add-btn zoom" value="Add New Topic"
                                       data-toggle="modal" data-target="#addTopicModal"/>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--========== End Topics Specification ==========-->

            <!--======== Marking Criteria ===========-->
            <div id="section4" class="section">
                <div class="container">
                    <br><br>
                    <div class="row" style="border-bottom: 2px solid #FF7350;"></div>
                    <br><br>
                    <h4 style="font-family: 'Noto Serif', serif; color: #274F73">Marking Criteria</h4>
                    <br><br>

                    <!-- Assignment Marking Criteria-->
                    <h5><strong>1. Assignment marking criteria </strong></h5>
                    <div class="row">
                        <div class="col-8 d-flex ml-3">
                            <div class="form-group row ml-1">
                                <label style="margin-right: 5px;">Upload Excel File: </label>
                                <form action="">
                                    <input type="file" id="myFile" name="filename">
                                </form>
                            </div>
                        </div>
                        <div class="col-3">
                            <input type="button" class="btn-sm bg-light zoom" value="Download Template" />
                        </div>
                    </div>

                    <!--Table for assignment marking criteria -->
                    <div id="assignmentMarkingTable" class="col-sm-12">
                        <table class="table table-bordered">
                            <thead>
                              <tr>
                                  <th scope="col" width="17%" class="text-center" style="font-size: 14px;">Criteria</th>
                                  <th scope="col" width="17%" class="text-center" style="font-size: 14px;">
                                      (HD) High Distinction <p style="font-size: 12px;">(80% <= marks <= 100%)</p></th>
                                  <th scope="col" width="17%" class="text-center" style="font-size: 14px;">
                                      (DN) Distinction <p style="font-size: 12px;">(70% <= marks < 80%)</p></th>
                                  <th scope="col" width="17%" class="text-center" style="font-size: 14px;">
                                      (CR) Credit <p style="font-size: 12px;">(60% <= marks < 70%)</p></th>
                                  <th scope="col" width="16%" class="text-center" style="font-size: 14px;">
                                      (PP) Pass <p style="font-size: 12px;">(50% <= marks < 60%)</p></th>
                                  <th scope="col" width="16%" class="text-center" style="font-size: 14px;">
                                      (NN) Fail <p style="font-size: 12px;">(marks < 50%)</p></th>
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
                            <input type="button" class="btn-sm add-btn zoom" value="Add New Marking Criteria"
                                   data-toggle="modal" data-target="#addCriteriaModal"/>
                        </div>
                    </div>

                    <br><br>
                    <!-- Assignment Feedback Criteria-->
                    <h5><strong>2. Feedback marking criteria</strong> </h5>
                    <div class="row">
                        <div class="col-8 d-flex ml-3">
                            <div class="form-group row ml-1">
                                <label style="margin-right: 5px;">Upload Excel File: </label>
                                <form action="">
                                    <input type="file" id="myFile" name="filename">
                                </form>
                            </div>
                        </div>
                        <div class="col-3">
                            <input type="button" class="btn-sm bg-light zoom" value="Download Template" />
                        </div>
                    </div>

                    <!--Table for Feedback marking criteria -->
                    <div id="feedbackMarkingTable" class="col-sm-12">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th scope="col" width="17%" class="text-center" style="font-size: 14px;">Criteria</th>
                                <th scope="col" width="17%" class="text-center" style="font-size: 14px;">
                                    (HD) High Distinction <p style="font-size: 12px;">(80% <= marks <= 100%)</p></th>
                                <th scope="col" width="17%" class="text-center" style="font-size: 14px;">
                                    (DN) Distinction <p style="font-size: 12px;">(70% <= marks < 80%)</p></th>
                                <th scope="col" width="17%" class="text-center" style="font-size: 14px;">
                                    (CR) Credit <p style="font-size: 12px;">(60% <= marks < 70%)</p></th>
                                <th scope="col" width="16%" class="text-center" style="font-size: 14px;">
                                    (PP) Pass <p style="font-size: 12px;">(50% <= marks < 60%)</p></th>
                                <th scope="col" width="16%" class="text-center" style="font-size: 14px;">
                                    (NN) Fail <p style="font-size: 12px;">(marks < 50%)</p></th>
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
                            <input type="button" class="btn-sm add-btn zoom" value="Add New Marking Criteria"
                                   data-toggle="modal" data-target="#addFeedbackCriteriaModal"/>
                        </div>
                    </div>
                    <br>
                </div>
                <!-- End Assignment Feedback Criteria-->
            </div>
            <!--======== End Marking Criteria ===========-->

            <!--======== Students Allocation ===========-->
            <div id="section6" class="section">
                <div class="container">
                    <br><br>
                    <div class="row" style="border-bottom: 2px solid #FF7350;"></div>
                    <br><br>
                    <h4 style="font-family: 'Noto Serif', serif; color: #274F73">Students Allocation</h4>
                    <br><br>

                    <div class="row">
                        <div class="col">
                            <div class="form-group row ml-1">
                                <label for="numPeers">Peers for assessment</label>
                                <span style="padding-left: 10px"></span>
                                <input type="number" name="peersNumber" class="col-sm-2" id="numPeers"/>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row ml-sm-1">
                        <label for="allocationStrategySelect">Review Allocation</label>
                        <span style="padding-left: 10px"></span>
                        <select id="allocationStrategySelect">
                            <option value="2">Random (with different topics)</option>
                            <option value="1">Random (with same topic)</option>
                            <option value="0">Manually (upload a .csv file)</option>
                        </select>
                    </div>

                </div>
                <br>
            </div>
            <!--======== End Students Allocation ===========-->

            <!--======== Submission Deadlines ===========-->
            <div id="section7" class="section">
                <div class="container">
                    <br><br>
                    <div class="row" style="border-bottom: 2px solid #FF7350;"></div>
                    <br><br>
                    <h4 style="font-family: 'Noto Serif', serif; color: #274F73">Submission Deadlines</h4>
                    <div class="form-left-padding">
                        <div class="form-group row">
                            <label for="topicSelectionDeadLine" class="col-sm-5 col-form-label">
                                Topic Selection Closing Date:</label>
                            <div class="col-sm-4">
                                <input type="datetime-local" class="form-control" id="topicSelectionDeadLine"
                                       placeholder="Topic Selection Closing Date">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="assignmentSubmissionDeadLine" class="col-sm-5 col-form-label">
                                Assignment Submission Deadline:</label>
                            <div class="col-sm-4">
                                <input type="datetime-local" class="form-control" id="assignmentSubmissionDeadLine"
                                       placeholder="Assignment Submission Deadline">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="assignmentSubmissionClosingDate" class="col-sm-5 col-form-label">
                                Assignment Submission Closing Date:</label>
                            <div class="col-sm-4">
                                <input type="datetime-local" class="form-control" id="assignmentSubmissionClosingDate"
                                       placeholder="Assignment Submission Closing Date">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="assignmentMarkingOpeningDate" class="col-sm-5 col-form-label">
                                Assignment Marking Opening Date:</label>
                            <div class="col-sm-4">
                                <input type="datetime-local" class="form-control" id="assignmentMarkingOpeningDate"
                                       placeholder="Assignment Marking Opening Date">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="assignmentMarkingClosingDate" class="col-sm-5 col-form-label">
                                Assignment Marking Closing Date:</label>
                            <div class="col-sm-4">
                                <input type="datetime-local" class="form-control" id="assignmentMarkingClosingDate"
                                       placeholder="Assignment Marking Closing Date">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="feedbackMarkingOpeningDate" class="col-sm-5 col-form-label">
                                Feedback Marking Opening Date:</label>
                            <div class="col-sm-4">
                                <input type="datetime-local" class="form-control" id="feedbackMarkingOpeningDate"
                                       placeholder="Feedback Marking Opening Date">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="feedbackMarkingClosingDate" class="col-sm-5 col-form-label">
                                Feedback Marking Closing Date:</label>
                            <div class="col-sm-4">
                                <input type="datetime-local" class="form-control" id="feedbackMarkingClosingDate"
                                       placeholder="Feedback Marking Closing Date">
                            </div>
                        </div>
                    </div>
                </div>
                <br>
            </div>
            <!--======== End Submission Deadlines ===========-->
            <div style="text-align:center; margin-bottom: 150px;">
                <button type="button" class="btn btn-info btn-md" onclick="location.reload()">Reset</button>
                <button type="button" class="btn btn-info btn-md" @click="saveAssignmentDetails">Finish</button>

                <!-- Modal -->
                <div class="modal fade" id="creatAssignmentComplete" role="dialog">
                    <div class="modal-dialog">

                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Notification</h4>
                                <button type="button" class="close" data-dismiss="modal" style="color: red;">&times;</button>
                            </div>
                            <div class="modal-body">
                                <p>You have saved information successfully!.</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-success" @click="modalClose">Done</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </div>
    </div>
</template>

<script>
    import NavBar from "./nav-bar";
    import config from "../../../config";
    import axios from "axios";
    import FeedbackCriteria from "./feedback-criteria"
    import AddTopic from "./add-topic";
    import AssignmentCriteria from "./assignment-criteria"
    import AssignmentCriteriaRow from "./assignment-criteria-row";

    export default {
        name: "create-assignment",
        components: {AssignmentCriteriaRow, AddTopic, AssignmentCriteria, FeedbackCriteria, NavBar},
        data() {
            return {
                units: [],
                topicSpecification: [],
                markingCriteria: [],
                feedbackCriteria: [],
                base: '',
                selectedUnit: '',
            }
        },
        mounted() {
            this.getLecturerUnits()
        },
        methods: {
          addTopicToAssignment(topic) {
            this.topicSpecification.push(topic)
          },
          addMarkingCriteria(markingCriteria) {
            this.markingCriteria.push(markingCriteria)
            console.log(markingCriteria)
          },
          addFeedbackCriteria(feedbackCriteria) {
            this.feedbackCriteria.push(feedbackCriteria);
          },
          getLecturerUnits() {
                this.base = config.BASE_URL
                let endpoint = config.BASE_URL + "api/lecturer/units"

                axios.get(endpoint, {
                    headers: {
                        'token': localStorage.token
                    }
                }).then((response) => {
                    this.units = response.data.units
                })
            },
            saveAssignmentDetails() {
                let formAction = this.base + "api/assignment/create";
                let data = populateNewAssignmentDetails();
                this.selectedUnit = data.unit;
                let config =
                    {
                        headers: {
                            'token': localStorage.token
                        }
                    }

                axios.post(formAction, {
                  unit: data.unit,
                  title: data.title,
                  learningOutcome: data.learningOutcome,
                  scenario: data.scenarios,
                  numOfReviews: data.numOfReviews,
                  allocationStrategy: data.allocationCategory,
                  deadline: data.deadline,
                  topicSpecification: this.topicSpecification,
                  markingCriteria: this.markingCriteria,
                  feedbackCriteria: this.feedbackCriteria
                },config)
                    .then((response) => {
                       if (response.data > 0) {
                         //window.location.reload()
                           $('#creatAssignmentComplete').modal('show');
                       }
                    })
                    .catch((error) => {
                      console.log(error)
                    });
            },
            modalClose() {
                window.location.href = 'http://localhost:8000/lecturer/assignments?unit=' + this.selectedUnit;
            }
        }
    }
</script>

<style scoped>

</style>
