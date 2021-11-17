/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default)
import Vue from 'vue'
import LoginComponent from './components/login'
import ManageAssignmentsComponent from './components/manage-assignments'
import NavBarComponent from './components/nav-bar'
import SubjectCardComponent from './components/subject-card'
import CreateAssignmentComponent from './components/create-assignment'
import FeedbackCriteriaComponent from './components/feedback-criteria'
import AddTopicComponent from './components/add-topic'
import AssignmentCriteriaComponent from './components/assignment-criteria'
import UnitAssignmentsComponent from './components/unit-assignments'
import AssignmentCriteriaRow from './components/assignment-criteria-row'
import AssignmentInfoSideBar from './components/assignment-info-sidebar'
import AssignmentInfoBreadcrumb from './components/assignment-info-breadcrumb'
import AssignmentInfoBasic from './components/assignment-info-basic'
import AssignmentInfoTopic from './components/assignment-info-topic'
import AssignmentInfoMarkingScheme from './components/assignment-info-marking-scheme'
import AssignmentInfoDeadline from './components/assignment-info-deadline'
import ManageStudents from './components/manage-students'
import UnitStudents from './components/unit-students'
import AssignmentInfoTopicAllocation from  './components/assignment-info-topic-allocation'
import AssignmentInfoPeerAllocation from './components/assignment-info-peer-allocation'
import UpdateAssignmentDetailsSuccess from './components/update-assignment-details-success'
import AssignmentMarkingDetails from './components/lecturer/assignment-marking-details'
import AssignmentMarkingSummary from './components/lecturer/assignment-marking-summary'
import AssignmentProgress from './components/lecturer/assignment-progress'
import AssignmentResults from './components/lecturer/assignment-results'
import Requests from './components/lecturer/requests'
import RequestDetails from './components/lecturer/request-details'


//student
import StudentHome from './components/student/student-home'
import StudentAssignments from './components/student/student-assignments'
import ViewAssignmentInfo from './components/student/view-assignment-info'
import ViewAssignmentSidebar from './components/student/view-assignment-sidebar'
import ViewAssignmentMarkingCriteria from './components/student/view-assignment-marking-criteria'
import ViewAssignmentTopics from './components/student/view-assignment-topics'
import ViewAssignmentSubmission from './components/student/view-assignment-submission'
import ViewAssignmentMarking from './components/student/view-assignment-marking'
import AssignmentMarking from './components/student/assignment-marking'
import AssignmentFeebackMarking from './components/student/assignment-feedback-marking'


Vue.component('login', LoginComponent)
Vue.component('manageAssignments', ManageAssignmentsComponent)
Vue.component('navBar', NavBarComponent)
Vue.component('subjectCard', SubjectCardComponent)
Vue.component('createAssignment', CreateAssignmentComponent)
Vue.component('feedbackCriteria', FeedbackCriteriaComponent)
Vue.component('addTopic', AddTopicComponent)
Vue.component('assignmentCriteria', AssignmentCriteriaComponent)
Vue.component('unitAssignment', UnitAssignmentsComponent)
Vue.component('assignmentCriteriaRow', AssignmentCriteriaRow)
Vue.component('assignmentInfoSideBar', AssignmentInfoSideBar)
Vue.component('assignmentInfoBreadcrumb', AssignmentInfoBreadcrumb)
Vue.component('assignmentInfoBasic', AssignmentInfoBasic)
Vue.component('assignmentInfoTopic', AssignmentInfoTopic)
Vue.component('assignmentInfoMarkingScheme', AssignmentInfoMarkingScheme)
Vue.component('assignmentInfoDeadline', AssignmentInfoDeadline)
Vue.component('manageStudents', ManageStudents)
Vue.component('unitStudents', UnitStudents)
Vue.component('assignmentInfoTopicAllocation', AssignmentInfoTopicAllocation)
Vue.component('assignmentInfoPeerAllocation', AssignmentInfoPeerAllocation)
Vue.component('updateAssignmentDetailsSuccess', UpdateAssignmentDetailsSuccess)
Vue.component('studentHome', StudentHome)
Vue.component('studentAssignment', StudentAssignments)
Vue.component('viewAssignmentInfo', ViewAssignmentInfo)
Vue.component('viewAssignmentSidebar', ViewAssignmentSidebar)
Vue.component('viewAssignmentMarkingCriteria', ViewAssignmentMarkingCriteria)
Vue.component('viewAssignmentTopic', ViewAssignmentTopics)
Vue.component('viewAssignmentSubmission', ViewAssignmentSubmission)
Vue.component('viewAssignmentMarking', ViewAssignmentMarking)
Vue.component('assignmentMarking', AssignmentMarking)
Vue.component('assignmentMarkingDetails', AssignmentMarkingDetails)
Vue.component('assignmentMarkingSummary', AssignmentMarkingSummary)
Vue.component('assignmentProgress', AssignmentProgress)
Vue.component('assignmentResults', AssignmentResults)
Vue.component('requests', Requests)
Vue.component('requestDetails', RequestDetails)
Vue.component('assignmentFeebackMarking', AssignmentFeebackMarking)

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    mounted() {
        if ((window.location.pathname !== '/home' && window.location.pathname !== '/login' &&
            window.location.pathname !== '/') && !localStorage.userName) {
            window.location = "/login";
        }
    }
});
