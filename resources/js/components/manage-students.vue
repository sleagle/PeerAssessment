<template>
  <div>
    <nav-bar
        v-bind:redirectLoc="'/lecturer/'">

    </nav-bar>
    <div class="container section box mx-auto" style="width: 80%; margin-top: 100px;">
      <div class="row" style="margin-top: 10px;padding: 5px;">
        <div class="col">
          <a href="/lecturer/" style="color: #274F73">LECTURER HOME / </a>
          <a href="#" style="color: #FF7350;">MANAGE STUDENTS</a>
        </div>
      </div>
      <div class="row d-flex justify-content-center" style="margin-top: 50px; margin-bottom: 100px;">
        <subject-card
            v-for="unit in units"
            v-bind:key="unit.unitCode"
            v-bind:unit="unit"
            v-bind:url="'/lecturer/unit/students?unit='+unit.unitCode"
            v-bind:isManageAssignment="false" v-bind:isManageStudent="true">

        </subject-card>
      </div>
    </div>
  </div>
</template>

<script>
  import lecturerUnitsMixin from "../mixins/lecturerUnitsMixin";
  import NavBar from "./nav-bar";
  import SubjectCard from "./subject-card";

  export default {
    name: "manage-students",
    components: {SubjectCard, NavBar},
    mixins: [lecturerUnitsMixin]
  }
</script>

<style scoped>

</style>
