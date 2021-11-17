<template>
    <div class="sidenav">
        <div class="dropdown-container">
            <a :class="{'active1':(currentView === 'info')}"
               :href="'/student/view/assignment/'+assignmentId+'/info'">Assignment Overview</a>
            <a :class="{'active1':(currentView === 'marking-criteria')}"
               :href="'/student/view/assignment/'+assignmentId+'/marking-criteria'">Marking Criteria</a>
            <a :class="{'active1':(currentView === 'topic-selection')}"
               :href="'/student/view/assignment/'+assignmentId+'/topic-selection'">Topic Selection</a>
            <a :class="{'active1':(currentView === 'submission')}"
               :href="'/student/view/assignment/'+assignmentId+'/submission'">Assignment Submission</a>
            <a :class="{'active1':(currentView === 'marking')}"
               :href="'/student/view/assignment/'+assignmentId+'/marking'">Assignment Marking</a>
            <a :class="{'active1':(currentView === 'feedback-marking')}"
               :href="'/student/view/assignment/'+assignmentId+'/feedback-marking'">Feedback Marking</a>
        </div>
    </div>
</template>

<script>
export default {
    name: "view-assignment-sidebar",
    props:['assignmentId', 'currentView']
}
</script>

<style scoped>

</style>
