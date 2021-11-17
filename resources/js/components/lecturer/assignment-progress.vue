<template>
    <div>
        <nav-bar>

        </nav-bar>
        <assignment-info-side-bar v-bind:assignmentId="assignmentId" v-bind:current-view="currentView">

        </assignment-info-side-bar>
        <div class="main" style="height: 100vh;">
            <div class="container box mx-auto" style="width: 90%; margin-top: 100px;  height: auto;">
                <assignment-info-breadcrumb v-bind:unit-code="unitCode" v-bind:current-breadcrumb="currentBreadcrumb">

                </assignment-info-breadcrumb>
                <div class="row ml-2 fadeIn animated">
                </div>
                <div class="row ml-3 fadeIn animated">
                    <div class="col-sm-2 mt-2">
                        <label>Sort by:</label>
                        <select>
                            <option>Name</option>
                            <option>ID</option>
                            <option>Topic</option>
                            <option>Date</option>
                        </select>
                    </div>
                    <div class="col-sm-4 fadeIn animated">
                        <form class="form-inline mr-auto" target="_self">
                            <div class="form-group">
                                <label>Search: &nbsp</label>
                                <label for="search-field"><i class="fa fa-search" style="color: rgb(53, 53, 53);"></i></label>
                                <input class="form-control search-field" type="search" id="search-field" name="search" style="border: none; color: rgb(53, 53, 53); text-decoration: underline;">
                            </div>
                        </form>
                    </div>
                </div>

                <!--============ Table ===========-->
                <div style="overflow:auto; height:600px; padding-right: 30px; padding-left: 30px;">

                    <table class="table table-bordered fadeIn animated" style="font-size:80% ;table-layout:fixed; width:100%;" cellspacing="0">
                        <thead>
                        <tr style="text-align: center;">
                            <th style="width: 30px;">#</th>
                            <th style="width: 100px;">Student Name</th>
                            <th style="width: 60px;">Student ID</th>
                            <th style="width: 100px;">Topic selected</th>
                            <th style="width: 200px;">Submission</th>
                            <th style="width: 80px;">Date</th>
                            <th style="width: 50px;">Evaluated peers</th>
                            <th style="width: 50px;">Assessed comments</th>
                        </tr>
                        </thead>

                    </table>
                    <div style="overflow:auto; height:500px; margin-top: -16px;" id="table-mark">

                        <table class="table table-bordered fadeIn animated" style="font-size:80% ;table-layout:fixed; width:100%; border-top: none;" cellspacing="0">
                            <tbody>
                            <tr style="text-align: center;">
                                <td style="width: 30px;">1</td>
                                <td style="width: 100px;">Van Y Pham</td>
                                <td style="width: 60px;">506153</td>
                                <td style="width: 100px;">Topic 1</td>
                                <td style="width: 200px;"><a href="assignment-display.html" target="blank">The submitted file</a></td>
                                <td style="width: 80px;">20.4.2020, 20:50</td>
                                <td style="width: 50px;">3/3</td>
                                <td style="width: 50px;">2/3</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "assignment-progress"
}
</script>

<style scoped>

</style>
