<template>
    <div class="modal fade" id="addFeedbackCriteriaModal" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Feedback Marking Criteria Addition</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="form-left-padding" name="feedbackMarkingCriteriaAddition">
                        <div class="col-sm-9 alert alert-danger add-feedback-required-error required-error"
                             role="alert" v-if="hasError">
                            All fields are Required!
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-2">
                                <label for="criteriaFb">Criteria</label>
                            </div>
                            <div class="col-sm-7">
                                <input type="text" class="form-control add-feedback-required"
                                       id="criteriaFb" placeholder="Feedback Criteria"
                                       name="criteriaFb" v-model="criteriaVal">
                            </div>
                            <div class="col-sm-1">
                                <label for="markFb">Mark:</label>
                            </div>
                            <div class="col-sm-2 mb-3">
                                <input type="number" class="form-control add-feedback-required" id="markFb"
                                       name="mark" v-model="marksVal">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-2">
                                <label for="hdCriteriaFb">High Distinction</label>
                                <label id="hdFbRange"></label>
                            </div>
                            <div class="col-sm-10">
                                <textarea class="form-control add-feedback-required" id="hdCriteriaFb"
                                          placeholder="HD" v-model="hdCriteriaVal"></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-2">
                                <label for="dnCriteriaFb">Distinction</label>
                                <label id="dnFbRange"></label>
                            </div>
                            <div class="col-sm-10">
                                <textarea class="form-control add-feedback-required" id="dnCriteriaFb"
                                          placeholder="DN" v-model="dnCriteriaVal"></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-2">
                                <label for="crCriteriaFb">Credit</label>
                                <label id="crFbRange"></label>
                            </div>
                            <div class="col-sm-10">
                                <textarea class="form-control add-feedback-required" id="crCriteriaFb"
                                          placeholder="CR" v-model="crCriteriaVal"></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-2">
                                <label for="ppCriteriaFb">Pass</label>
                                <label id="ppFbRange"></label>
                            </div>
                            <div class="col-sm-10">
                                <textarea class="form-control add-feedback-required" id="ppCriteriaFb"
                                          placeholder="PP" v-model="ppCriteriaVal"></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-2">
                                <label for="nnCriteriaFb">Fail</label>
                                <label id="nnFbRange"></label>
                            </div>
                            <div class="col-sm-10">
                                <textarea class="form-control add-feedback-required" id="nnCriteriaFb"
                                          placeholder="NN" v-model="nnCriteriaVal"></textarea>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" @click="resetForm">Close</button>
                    <button type="button" class="btn btn-success"
                            @click="addFeedbackCriteria">Save changes</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "feedback-criteria",
        data() {
            return {
              hasError: false,
              criteriaVal: '',
              marksVal: null,
              hdCriteriaVal: '',
              dnCriteriaVal: '',
              crCriteriaVal: '',
              ppCriteriaVal: '',
              nnCriteriaVal: '',
            }
        },
        methods: {
            addFeedbackCriteria() {
                if (!this.criteriaVal || !this.marksVal || !this.hdCriteriaVal || !this.dnCriteriaVal
                    || !this.crCriteriaVal || !this.ppCriteriaVal || !this.nnCriteriaVal) {

                    this.hasError = true
                }
                else {
                    let feedbackCriteria = {
                      criteria: this.criteriaVal,
                      marks: this.marksVal,
                      hdCriteria: this.hdCriteriaVal,
                      dnCriteria: this.dnCriteriaVal,
                      crCriteria: this.crCriteriaVal,
                      ppCriteria: this.ppCriteriaVal,
                      nnCriteria: this.nnCriteriaVal
                    }
                    this.$emit('clicked', feedbackCriteria);

                    this.resetForm()
                }
            },
            resetForm() {
                this.criteriaVal = "";
                this.marksVal = null
                this.hdCriteriaVal = "";
                this.dnCriteriaVal = "";
                this.crCriteriaVal = "";
                this.ppCriteriaVal = "";
                this.nnCriteriaVal = "";
                formReset('addFeedbackCriteriaModal');
            }
        }
    }
</script>

<style scoped>

</style>