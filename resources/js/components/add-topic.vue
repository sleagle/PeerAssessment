<template>
    <div class="modal fade" id="addTopicModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">New Topic Addition</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="form-left-padding">
                        <div class="col-sm-8 alert alert-danger add-topic-required-error required-error"
                             role="alert" v-if="hasError">
                            All fields are Required!
                        </div>
                        <div class="form-group row">
                            <label for="topicTitle" class="col-sm-2 col-form-label">Topic Title:</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control add-topic-required" id="topicTitle"
                                       placeholder="Topic Title" v-model="titleVal">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="studentsAllowed" class="col-sm-4 col-form-label">Students Allowed for the topic:</label>
                            <div class="col-sm-4">
                                <input type="number" class="form-control add-topic-required" id="studentsAllowed"
                                       placeholder="Number of Students" v-model="numStudentsVal">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal" @click="addTopicFormReset">Close</button>
                    <button type="button" class="btn btn-success" @click="addTopicToAssignment">Save changes</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "add-topic",
        props: ['count'],
        data() {
            return {
              hasError: false,
              titleVal: '',
              numStudentsVal: null,
            }
        },
        methods: {
            addTopicToAssignment() {
                if (!this.titleVal || !this.numStudentsVal) {
                    this.hasError = true
                }
                else {
                    this.hasError = false
                    let topicCount = this.count
                    let topic = {
                      rowNum: ++topicCount,
                      title: this.titleVal,
                      numStudents: this.numStudentsVal
                    }
                    this.$emit('clicked', topic);

                    this.addTopicFormReset()
                }
            },
            addTopicFormReset() {
                this.titleVal = ''
                this.numStudentsVal = null
                formReset('addTopicModal');
            }
        }
    }
</script>

<style scoped>

</style>