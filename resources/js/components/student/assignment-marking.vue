<template>
    <div>
        <nav-bar
            v-bind:redirectLoc="'/student/'">

        </nav-bar>
        <section id="main">
            <div class="container">
                <div class="row d-flex pl-3 pt-3 direction" style="margin-top: 60px; margin-bottom: 20px; margin-left: 12px;">
                    <a style="color: #274F73;" href="/student/">HOME /</a>
                    <a style="color: #274F73;" :href="'/student/assignments?unit='+unitCode">&nbsp {{ unitCode }} /</a>
                    <a style="color: #274F73;" href="assignments-marking.html">&nbsp ASSIGNMENT MARKING /</a>
                    <a style="color: #ff7350;" href="marking-editing-assignments.html">&nbsp MARKING & EDITING</a>
                </div>
                <div class="splitter">
                    <!--====== Left side ========-->
                    <div id="leftSide" class="outdiv">
                        <div class="indiv">
                            <br>
                            <!--====== Accordion ======-->
                            <div id="accordion">
                                <!--======Criteria 1 ======-->
                                <div class="card" v-for="criterion in markingCriteria">
                                    <div class="card-header">
                                        <a class="collapsed card-link" data-toggle="collapse" :href="'cra'">
                                            CRA: {{ criterion.description }}
                                        </a>
                                    </div>
                                    <div :id="'cra'" class="collapse" data-parent="#accordion">
                                        <div class="card-body">
                                            <table class="table" style="font-size: 12px;">
                                                <thead>
                                                <tr>
                                                    <td>Grade</td>
                                                    <td>Criteria details</td>
                                                    <td>Mark range</td>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <tr>
                                                    <td>HD (High Distinction)</td>
                                                    <td>{{ criterion.hdCriteria.description }}
                                                        <ul v-for="hdSubCriterion in criterion.hdCriteria.subCriteria">
                                                            <li>{{ hdSubCriterion.mark }}: {{ hdSubCriterion.description }}</li>
                                                        </ul>
                                                    </td>
                                                    <td>
                                                        <div class="form-check form-check-inline" v-for="hdSubCriterion in criterion.hdCriteria.subCriteria">
                                                            <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadioHd" value="option1">
                                                            <label class="form-check-label" for="inlineRadioHd">{{ hdSubCriterion.mark }}</label>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>DN (Distinction)</td>
                                                    <td>{{ criterion.dnCriteria.description }}
                                                        <ul v-for="dnSubCriterion in criterion.dnCriteria.subCriteria">
                                                            <li>{{ dnSubCriterion.mark }}: {{ dnSubCriterion.description }}</li>
                                                        </ul>
                                                    </td>
                                                    <td>
                                                        <div class="form-check form-check-inline" v-for="dnSubCriterion in criterion.dnCriteria.subCriteria">
                                                            <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadioDn" value="option1">
                                                            <label class="form-check-label" for="inlineRadioDn">{{ dnSubCriterion.mark }}</label>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>CR (Credit)</td>
                                                    <td>{{ criterion.crCriteria.description }}
                                                        <ul v-for="crSubCriterion in criterion.crCriteria.subCriteria">
                                                            <li>{{ crSubCriterion.mark }}: {{ crSubCriterion.description }}</li>
                                                        </ul>
                                                    </td>
                                                    <td>
                                                        <div class="form-check form-check-inline" v-for="crSubCriterion in criterion.crCriteria.subCriteria">
                                                            <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadioCr" value="option1">
                                                            <label class="form-check-label" for="inlineRadioCr">{{ crSubCriterion.mark }}</label>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>PP (Pass)</td>
                                                    <td>{{ criterion.ppCriteria.description }}
                                                        <ul v-for="ppSubCriterion in criterion.ppCriteria.subCriteria">
                                                            <li>{{ ppSubCriterion.mark }}: {{ ppSubCriterion.description }}</li>
                                                        </ul>
                                                    </td>
                                                    <td>
                                                        <div class="form-check form-check-inline" v-for="ppSubCriterion in criterion.ppCriteria.subCriteria">
                                                            <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadioPp" value="option1">
                                                            <label class="form-check-label" for="inlineRadioPp">{{ ppSubCriterion.mark }}</label>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>NN (Fail)</td>
                                                    <td>{{ criterion.nnDescription.description }}
                                                        <ul v-for="nnSubCriterion in criterion.nnDescription.subCriteria">
                                                            <li>{{ nnSubCriterion.mark }}: {{ nnSubCriterion.description }}</li>
                                                        </ul>
                                                    </td>
                                                    <td>
                                                        <div class="form-check form-check-inline" v-for="nnSubCriterion in criterion.nnDescription.subCriteria">
                                                            <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadioNn" value="option1">
                                                            <label class="form-check-label" for="inlineRadioNn">{{ nnSubCriterion.mark }}</label>
                                                        </div>
                                                    </td>
                                                </tr>
                                                </tbody>
                                            </table>

                                            <!--======== Exact mark and comments =========-->
                                            <div class="row">
                                                <div class="col col-sm-3">
                                                    <div class="form-group">
                                                        <label>Mark</label>
                                                        <input type="number" class="form-control" aria-describedby="mark" style="width: 80%;">
                                                    </div>
                                                </div>
                                                <div class="col col-sm-9">
                                                    <div class="md-form">
                                                        <label for="form">Comment</label>
                                                        <textarea id="form" class="md-textarea form-control" rows="3"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--======== End Exact mark and comments =========-->
                                        </div>
                                    </div>
                                </div>
                                <!--====== End Criteria 1 ======-->
                            </div>
                            <!--======= End Accordion ===========-->
                            <br>
                            <!--======== Save button =====-->
                            <div class="container text-left fadeIn animated">
                                <button type="button" class="btn-pas zoom" onclick="">Save</button>
                            </div>
                            <!--======== End Save button =====-->
                            <br>
                        </div>
                    </div>
                    <div id="separator"></div>

                    <!--======== Right side =========-->
                    <div id="rightSide" class="outdiv">
                        <div class="indiv">
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</template>

<script>
import config from "../../../../config";
import axios from "axios";
import assignmentInfoMixin from "../../mixins/assignmentInfoMixin";

export default {
    name: "assignment-marking",
    mixins: [assignmentInfoMixin],
    data() {
        return {
            counter: 0,
            unitCode: '',
            markingCriteria: []
        }
    },
    mounted() {
        this.loadAssignmentCriteriaData()
    },
    methods: {
        loadAssignmentCriteriaData() {
            console.log(this.assignmentId)
            let endpoint = config.BASE_URL + "api/assignment/" + this.assignmentId + "/marking-criteria"

            axios.get(endpoint, {
                headers: {
                    'token': localStorage.token
                }
            }).then((response) => {
                this.unitCode = response.data.unitCode
                this.markingCriteria = response.data.markingCriteria
                console.log(this.markingCriteria)
            })
        },
        incrementCounter()
        {
            return this.counter++
        }
    }
}
</script>

<style scoped>

</style>
