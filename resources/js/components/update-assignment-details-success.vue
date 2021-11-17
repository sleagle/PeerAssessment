<template>
  <div class="modal fade" id="saveOrUpdateAssignmentDetails" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Notification</h4>
          <button type="button" class="close" data-dismiss="modal" style="color: red;">&times;</button>
        </div>
        <div class="modal-body">
          <p>You have saved changes successfully!.</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-success" data-dismiss="modal">Done</button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
name: "update-assignment-details-success"
}
</script>

<style scoped>

</style>