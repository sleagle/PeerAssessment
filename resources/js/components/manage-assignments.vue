<template>
    <div>
        <nav-bar
            v-bind:redirectLoc="'/lecturer/'">

        </nav-bar>
        <div class="container section box mx-auto" style="margin-top: 100px; width: 80%;">
            <div class="row">
                <div class="col">
                    <a href="/lecturer/" style="color: #274F73">LECTURER HOME / </a>
                    <a href="#" style="color: #FF7350;">MANAGE ASSIGNMENTS</a>
                </div>
            </div>
            <div class="row d-flex justify-content-center" style="margin-top: 50px; margin-bottom: 100px;">
                <subject-card
                        v-for="unit in units"
                        v-bind:key="unit.unitCode"
                        v-bind:unit="unit"
                        v-bind:url="'/lecturer/assignments?unit='+unit.unitCode"
                        v-bind:isManageAssignment="true" v-bind:isManageStudent="false">

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
        name: "manage-assignments",
        components: {SubjectCard, NavBar},
        mixins: [lecturerUnitsMixin]
    }
</script>

<style scoped>

</style>
