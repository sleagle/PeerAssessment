<template>
  <div class="row d-flex pl-3 ml-3" style="margin-top: 10px;">
    <a style="color: #274F73;" href="/lecturer/">LECTURER HOME /</a>
    <a style="color: #274F73;" href="/lecturer/manage-assignments">&nbsp MANAGE ASSIGNMENTS /</a>
    <a style="color: #274F73;" :href="'/lecturer/assignments?unit='+unitCode">&nbsp {{ unitCode }}/</a>
    <a style="color: #ff7350;" href="#">&nbsp {{ currentBreadcrumb }}</a>
  </div>
</template>

<script>
export default {
  name: "assignment-info-breadcrumb",
  props: ['unitCode', 'currentBreadcrumb']
}
</script>

<style scoped>

</style>
