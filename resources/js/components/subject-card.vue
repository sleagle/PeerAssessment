<template>
    <div class="col-sm-6 col-md-5 px-3 py-3 ml-3 text-center" data-aos="fadeIn" data-aos-duration="1000">
        <a class="zoom" :href="url" style="display: inline-block;">
            <div v-bind:class="{ card: isManageAssignment , card1: isManageStudent}">
                <div>
                    <h1>{{ unit.unitCode }}</h1>
                    <label style="color: #ff7350;">{{ unit.unitName }}</label>
                </div>
            </div>
        </a>
    </div>
</template>

<script>
    export default {
        name: "subject-card",
        props: ['unit','url', 'isManageAssignment', 'isManageStudent']
    }
</script>

<style scoped>

</style>