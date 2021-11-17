<template>
    <div class="modal fade" id="addCriteriaModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Assignment Marking Criteria Addition</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form class="form-left-padding" name="markingCriteriaAddition">
                    <div class="modal-body">
                        <div class="col-sm-9 alert alert-danger add-criteria-required-error required-error"
                             v-if="hasError" role="alert">
                            All fields are Required!
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-2">
                                <label for="criteria">Criteria</label>
                            </div>
                            <div class="col-sm-7">
                                <input type="text" class="form-control add-criteria-required" id="criteria"
                                       placeholder="Criteria" name="criteria">
                            </div>
                            <div class="col-sm-1">
                                <label for="mark">Mark:</label>
                            </div>
                            <div class="col-sm-2 mb-3">
                                <input type="number" class="form-control add-criteria-required"
                                       id="mark" name="mark" v-model="marksVal">
                            </div>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                        </div>

                        <!--===== HD Criteria =======-->
                        <div class="form-group row">
                            <div class="col-sm-2">
                                <label for="hdCriteria">High Distinction</label><br>
                                <label id="hdRange"></label>
                            </div>
                            <div class="col-sm-7">
                                <textarea class="form-control add-criteria-required" id="hdCriteria"
                                          placeholder="Common criteria"></textarea>
                            </div>
                            <div class="col-sm-1">
                                <label>Interval:</label>
                            </div>
                            <div class="col-sm-1">
                                <select id="intervalSelectHd" name="form-select"
                                        onchange="onCriteriaIntervalChange('intervalSelectHd', this)">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                </select>
                            </div>
                        </div>

                        <!--Interval HD 2 select-->
                        <div class="form-group row internal-criteria" id="intervalHd2" style="border-bottom: 1px dashed blue; display: none;">
                            <div class="row d-flex ml-1 mb-2">
                                <div class="col-sm-3">
                                    <label class="row d-flex ml-1" id="hd2-mk1"></label>
                                </div>
                                <div class="col-sm-6">
                                    <textarea class="form-control internal-hd2" id="hd2-1" placeholder="Specific criteria"></textarea>
                                </div>
                            </div>
                            <div class="row d-flex ml-1">
                                <div class="col-sm-3">
                                    <label class="row d-flex ml-1" id="hd2-mk2"></label>
                                </div>
                                <div class="col-sm-6 mb-3">
                                    <textarea class="form-control internal-hd2" id="hd2-2" placeholder="Specific criteria"></textarea>
                                </div>
                            </div>
                        </div>
                        <!--End Interval HD 2 select-->

                        <!--Interval HD 3 select-->
                        <div class="form-group row internal-criteria" id="intervalHd3" style="border-bottom: 1px dashed blue; display: none;">
                            <div class="row d-flex ml-1 mb-2">
                                <div class="col-sm-3">
                                    <label class="row d-flex ml-1" id="hd3-mk1"></label>
                                </div>
                                <div class="col-sm-6">
                                    <textarea class="form-control internal-hd3" id="hd3-1" placeholder="Specific criteria"></textarea>
                                </div>
                            </div>
                            <div class="row d-flex ml-1">
                                <div class="col-sm-3">
                                    <label class="row d-flex ml-1" id="hd3-mk2"></label>
                                </div>
                                <div class="col-sm-6 mb-3">
                                    <textarea class="form-control internal-hd3" id="hd3-2" placeholder="Specific criteria"></textarea>
                                </div>
                            </div>
                            <div class="row d-flex ml-1">
                                <div class="col-sm-3">
                                    <label class="row d-flex ml-1" id="hd3-mk3"></label>
                                </div>
                                <div class="col-sm-6 mb-3">
                                    <textarea class="form-control internal-hd3" id="hd3-3" placeholder="Specific criteria"></textarea>
                                </div>
                            </div>
                        </div>
                        <!--End Interval HD 3 select-->
                        <!--===== End HD Criteria =======-->

                        <!--===== DN Criteria ========-->
                        <div class="form-group row">
                            <div class="col-sm-2">
                                <label>Distinction</label><br>
                                <label id="dnRange"></label>
                            </div>
                            <div class="col-sm-7">
                                <textarea class="form-control add-criteria-required" id="dnCriteria" placeholder="Common criteria"></textarea>
                            </div>
                            <div class="col-sm-1">
                                <label>Interval:</label>
                            </div>
                            <div class="col-sm-1">
                                <select id="intervalSelectDn" name="form-select" onchange="onCriteriaIntervalChange('intervalSelectDn', this)">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                </select>
                            </div>
                        </div>

                        <!--Interval DN 2 select-->
                        <div class="form-group row internal-criteria" id="intervalDn2" style="border-bottom: 1px dashed blue;">
                            <div class="row d-flex ml-1 mb-2">
                                <div class="col-sm-3">
                                    <label class="row d-flex ml-1" id="dn2-mk1"></label>
                                </div>
                                <div class="col-sm-6">
                                    <textarea class="form-control internal-dn2" id="dn2-1" placeholder="Specific criteria"></textarea>
                                </div>
                            </div>
                            <div class="row d-flex ml-1">
                                <div class="col-sm-3">
                                    <label class="row d-flex ml-1" id="dn2-mk2"></label>
                                </div>
                                <div class="col-sm-6 mb-3">
                                    <textarea class="form-control internal-dn2" id="dn2-2" placeholder="Specific criteria"></textarea>
                                </div>
                            </div>
                        </div>
                        <!--End Interval DN 2 select-->

                        <!--Interval DN 3 select-->
                        <div class="form-group row internal-criteria" id="intervalDn3" style="border-bottom: 1px dashed blue;">
                            <div class="row d-flex ml-1 mb-2">
                                <div class="col-sm-3">
                                    <label class="row d-flex ml-1" id="dn3-mk1"></label>
                                </div>
                                <div class="col-sm-6">
                                    <textarea class="form-control internal-dn3" id="dn3-1" placeholder="Specific criteria"></textarea>
                                </div>
                            </div>
                            <div class="row d-flex ml-1">
                                <div class="col-sm-3">
                                    <label class="row d-flex ml-1" id="dn3-mk2"></label>
                                </div>
                                <div class="col-sm-6 mb-3">
                                    <textarea class="form-control internal-dn3" id="dn3-2" placeholder="Specific criteria"></textarea>
                                </div>
                            </div>
                            <div class="row d-flex ml-1">
                                <div class="col-sm-3">
                                    <label class="row d-flex ml-1" id="dn3-mk3"></label>
                                </div>
                                <div class="col-sm-6 mb-3">
                                    <textarea class="form-control internal-dn3" id="dn3-3" placeholder="Specific criteria"></textarea>
                                </div>
                            </div>
                        </div>
                        <!--End Interval DN 3 select-->
                        <!--====== End DN Criteria =======-->

                        <!--====== CR Criteria =======-->
                        <div class="form-group row">
                            <div class="col-sm-2">
                                <label>Credit</label><br>
                                <label id="crRange"></label>
                            </div>
                            <div class="col-sm-7">
                                <textarea class="form-control add-criteria-required" id="crCriteria" placeholder="Common criteria"></textarea>
                            </div>
                            <div class="col-sm-1">
                                <label>Interval:</label>
                            </div>
                            <div class="col-sm-1">
                                <select id="intervalSelectCr" name="form-select" onchange="onCriteriaIntervalChange('intervalSelectCr', this)">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                </select>
                            </div>
                        </div>

                        <!--Interval CR 2 select-->
                        <div class="form-group row internal-criteria" id="intervalCr2" style="border-bottom: 1px dashed blue; ">
                            <div class="row d-flex ml-1 mb-2">
                                <div class="col-sm-3">
                                    <label class="row d-flex ml-1" id="cr2-mk1"></label>
                                </div>
                                <div class="col-sm-6">
                                    <textarea class="form-control internal-cr2" id="cr2-1" placeholder="Specific criteria"></textarea>
                                </div>
                            </div>
                            <div class="row d-flex ml-1">
                                <div class="col-sm-3">
                                    <label class="row d-flex ml-1" id="cr2-mk2"></label>
                                </div>
                                <div class="col-sm-6 mb-3">
                                    <textarea class="form-control internal-cr2" id="cr2-2" placeholder="Specific criteria"></textarea>
                                </div>
                            </div>
                        </div>
                        <!--End Interval CR 2 select-->

                        <!--Interval CR 3 select-->
                        <div class="form-group row internal-criteria" id="intervalCr3" style="border-bottom: 1px dashed blue; ">
                            <div class="row d-flex ml-1 mb-2">
                                <div class="col-sm-3">
                                    <label class="row d-flex ml-1" id="cr3-mk1"></label>
                                </div>
                                <div class="col-sm-6">
                                    <textarea class="form-control internal-cr3" id="cr3-1" placeholder="Specific criteria"></textarea>
                                </div>
                            </div>
                            <div class="row d-flex ml-1">
                                <div class="col-sm-3">
                                    <label class="row d-flex ml-1" id="cr3-mk2"></label>
                                </div>
                                <div class="col-sm-6 mb-3">
                                    <textarea class="form-control internal-cr3" id="cr3-2" placeholder="Specific criteria"></textarea>
                                </div>
                            </div>
                            <div class="row d-flex ml-1">
                                <div class="col-sm-3">
                                    <label class="row d-flex ml-1" id="cr3-mk3"></label>
                                </div>
                                <div class="col-sm-6 mb-3">
                                    <textarea class="form-control internal-cr3" id="cr3-3" placeholder="Specific criteria"></textarea>
                                </div>
                            </div>
                        </div>
                        <!--End Interval CR 3 select-->

                        <!--====== End CR Criteria =======-->

                        <!--====== PP Criteria =======-->
                        <div class="form-group row">
                            <div class="col-sm-2">
                                <label>Pass</label><br>
                                <label id="ppRange"></label>
                            </div>
                            <div class="col-sm-7">
                                <textarea class="form-control add-criteria-required" id="ppCriteria" placeholder="Common criteria"></textarea>
                            </div>
                            <div class="col-sm-1">
                                <label>Interval:</label>
                            </div>
                            <div class="col-sm-1">
                                <select id="intervalSelectPp" name="form-select" onchange="onCriteriaIntervalChange('intervalSelectPp', this)">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                </select>
                            </div>
                        </div>

                        <!--Interval PP 2 select-->
                        <div class="form-group row internal-criteria" id="intervalPp2" style="border-bottom: 1px dashed blue;">
                            <div class="row d-flex ml-1 mb-2">
                                <div class="col-sm-3">
                                    <label class="row d-flex ml-1" id="pp2-mk1"></label>
                                </div>
                                <div class="col-sm-6">
                                    <textarea class="form-control internal-pp2" id="pp2-1" placeholder="Specific criteria"></textarea>
                                </div>
                            </div>
                            <div class="row d-flex ml-1">
                                <div class="col-sm-3">
                                    <label class="row d-flex ml-1" id="pp2-mk2"></label>
                                </div>
                                <div class="col-sm-6 mb-3">
                                    <textarea class="form-control internal-pp2" id="pp2-2" placeholder="Specific criteria"></textarea>
                                </div>
                            </div>
                        </div>
                        <!--End Interval PP 2 select-->

                        <!--Interval PP 3 select-->
                        <div class="form-group row internal-criteria" id="intervalPp3" style="border-bottom: 1px dashed blue;">
                            <div class="row d-flex ml-1 mb-2">
                                <div class="col-sm-3">
                                    <label class="row d-flex ml-1" id="pp3-mk1"></label>
                                </div>
                                <div class="col-sm-6">
                                    <textarea class="form-control internal-pp3" id="pp3-1" placeholder="Specific criteria"></textarea>
                                </div>
                            </div>
                            <div class="row d-flex ml-1">
                                <div class="col-sm-3">
                                    <label class="row d-flex ml-1" id="pp3-mk2"></label>
                                </div>
                                <div class="col-sm-6 mb-3">
                                    <textarea class="form-control internal-pp3" id="pp3-2" placeholder="Specific criteria"></textarea>
                                </div>
                            </div>
                            <div class="row d-flex ml-1">
                                <div class="col-sm-3">
                                    <label class="row d-flex ml-1" id="pp3-mk3"></label>
                                </div>
                                <div class="col-sm-6 mb-3">
                                    <textarea class="form-control internal-pp3" id="pp3-3" placeholder="Specific criteria"></textarea>
                                </div>
                            </div>
                        </div>
                        <!--End Interval PP 3 select-->

                        <!--====== End PP Criteria =======-->

                        <!--====== Fail Criteria =======-->
                        <div class="form-group row">
                            <div class="col-sm-2">
                                <label>Fail</label><br>
                                <label id="nnRange"></label>
                            </div>
                            <div class="col-sm-7">
                                <textarea class="form-control add-criteria-required" id="nnCriteria" placeholder="NN"></textarea>
                            </div>
                        </div>
                        <!--====== End Fail Criteria =======-->
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" @click="addCriteriaFormReset">Close</button>
                        <button type="button" class="btn btn-success" @click="addMarkingCriteria">
                          Save changes
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "assignment-criteria",
        data() {
            return {
                hasError: false,
                marksVal: null
            }
        },
        methods: {
            addMarkingCriteria() {

              if (isValid('add-criteria')) {
                this.hasError = false
                let markingCriteria = addCriteriaToAssignment();

                this.$emit('clicked', markingCriteria);

                this.addCriteriaFormReset()
              }
              else {
                this.hasError = true
              }
            },
            addCriteriaFormReset() {
                this.marksVal = null
                formReset('addCriteriaModal');
            }
        }
    }
</script>

<style scoped>

</style>
