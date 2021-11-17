<template>
  <div class="sidenav">
    <button class="dropdown-btn">Assignment Management
      <i class="fa fa-caret-down"></i>
    </button>
    <div class="dropdown-container">
      <a :class="{'active1':(currentView === 'info')}"
         :href="'/lecturer/manage-assignments/assignment/'+assignmentId+'/info'">Basic Description</a>
      <a :class="{'active1':(currentView === 'topics-spec')}"
         :href="'/lecturer/manage-assignments/assignment/'+assignmentId+'/topics-spec'">Topics Specification</a>
      <a :class="{'active1':(currentView === 'topics-allocation')}"
         :href="'/lecturer/manage-assignments/assignment/'+assignmentId+'/topics-allocation'">Topics Allocation</a>
      <a :class="{'active1':(currentView === 'marking-criteria')}"
         :href="'/lecturer/manage-assignments/assignment/'+assignmentId+'/marking-criteria'">Marking Criteria</a>
      <a :class="{'active1':(currentView === 'peer-allocation')}"
         :href="'/lecturer/manage-assignments/assignment/'+assignmentId+'/peer-allocation'">Peers Allocation</a>
      <a :class="{'active1':(currentView === 'deadlines')}"
         :href="'/lecturer/manage-assignments/assignment/'+assignmentId+'/deadlines'">Submission Deadlines</a>
      <a :class="{'active1':(currentView === 'progress')}"
         :href="'/lecturer/manage-assignments/assignment/'+assignmentId+'/progress'">Assignment Progress</a>
    </div>
    <button class="dropdown-btn1">Assignment Marking
      <i class="fa fa-caret-down"></i>
    </button>
    <div class="dropdown-container">
      <a :class="{'active1':(currentView === 'marking-summary')}"
         :href="'/lecturer/manage-assignments/assignment/'+assignmentId+'/marking-summary'">Marking Summary</a>
      <a :class="{'active1':(currentView === 'marking-details')}"
         :href="'/lecturer/manage-assignments/assignment/'+assignmentId+'/marking-details'">Marking Details</a>
    </div>
    <a :class="{'active1':(currentView === 'results')}"
       :href="'/lecturer/manage-assignments/assignment/'+assignmentId+'/results'" style="margin-left: 15px;">Assignment Results</a>
  </div>
</template>

<script>
export default {
  name: "assignment-info-sidebar",
  props:['assignmentId', 'currentView']
}
</script>

<style scoped>

</style>
