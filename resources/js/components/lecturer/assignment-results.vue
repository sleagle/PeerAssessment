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
                <div class="row ml-2">
                    <div class="col-sm-6"></div>
                    <div class="col-sm-3"></div>
                    <div class="col-sm-3">
                        <div class="dropdown2">
                            <button onclick="myFunction()" class="dropbtn">
                                <span class="dot" style="margin-right: 2px;"></span>
                                <span class="dot" style="margin-right: 2px;"></span>
                                <span class="dot"></span>
                            </button>
                            <div id="myDropdown2" class="dropdown2-content">
                                <a href="">View in full screen</a>
                                <a href="">Print chart</a>
                                <div class="divided"></div>
                                <a href="">Save as PNG image</a>
                                <a href="">Save as JPEG image</a>
                                <a href="">Save as SVG vector image</a>
                                <a href="">Save as PDF file</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="fadeIn animated" style="text-align: center;">
                    <h4 style="display: inline-block;">Total marks distribution in the group of students</h4>
                    <br>
                    <img src="/img/total-marks-distribution.png">
                </div>
                <div class="row ml-3 fadeIn animated">
                    <div class="col-sm-2 mt-2">
                        <label>Sort by:</label>
                        <select>
                            <option>Name</option>
                            <option>ID</option>
                            <option>Mark</option>
                        </select>
                    </div>
                    <div class="col-sm-4">
                        <form class="form-inline mr-auto" target="_self">
                            <div class="form-group">
                                <label>Search: &nbsp</label>
                                <label for="search-field"><i class="fa fa-search" style="color: rgb(53, 53, 53);"></i></label>
                                <input class="form-control search-field" type="search" id="search-field" name="search" style="border: none; color: rgb(53, 53, 53); text-decoration: underline;">
                            </div>
                        </form>
                    </div>
                    <div class="pl-1 fadeIn animated" style="overflow:auto; height:600px; margin-left: 30px; padding-right: 30px;">
                        <table class="table" style="font-size:80% ;table-layout:fixed; width:100%;" cellspacing="0">
                            <thead>
                            <tr style="text-align: center;">
                                <th style="width: 30px; border-left: 1px solid #eeeeee; border-bottom: 1px solid #eeeeee;">#</th>
                                <th style="width: 80px; border-left: 1px solid #eeeeee; border-bottom: 1px solid #eeeeee;">Student ID</th>
                                <th style="width: 150px; border-left: 1px solid #eeeeee; border-bottom: 1px solid #eeeeee;">Student Name</th>
                                <th style="width: 100px; border-left: 1px solid #eeeeee; border-bottom: 1px solid #eeeeee;">Username</th>
                                <th style="width: 40px; border-left: 1px solid #eeeeee; border-bottom: 1px solid #eeeeee; border-right: 1px solid #eeeeee;">Mark</th>
                                <th style="width: 50px; border-bottom: none; border-top: none;"></th>
                                <th style="width: 30px; border-left: 1px solid #eeeeee; border-bottom: 1px solid #eeeeee;">#</th>
                                <th style="width: 80px; border-left: 1px solid #eeeeee; border-bottom: 1px solid #eeeeee;">Student ID</th>
                                <th style="width: 150px; border-left: 1px solid #eeeeee; border-bottom: 1px solid #eeeeee;">Student Name</th>
                                <th style="width: 100px; border-left: 1px solid #eeeeee; border-bottom: 1px solid #eeeeee;">Username</th>
                                <th style="width: 40px; border-left: 1px solid #eeeeee; border-bottom: 1px solid #eeeeee; border-right: 1px solid #eeeeee;">Mark</th>
                            </tr>
                            </thead>
                        </table>
                        <div style="overflow:auto; height:500px; margin-top: -16px;" id="table-mark">
                            <table class="table table-bordered" style="font-size:80% ;table-layout:fixed; width:100%; border-top: none;" cellspacing="0">
                                <tbody>
                                <tr style="text-align: center;">
                                    <td style="width: 30px; border-left: 1px solid #eeeeee; border-bottom: 1px solid #eeeeee;">1</td>
                                    <td style="width: 80px; border-left: 1px solid #eeeeee; border-bottom: 1px solid #eeeeee;">506153</td>
                                    <td style="width: 150px; border-left: 1px solid #eeeeee; border-bottom: 1px solid #eeeeee;">Van Y Pham</td>
                                    <td style="width: 100px; border-left: 1px solid #eeeeee; border-bottom: 1px solid #eeeeee;">vypham</td>
                                    <td style="width: 40px; border-left: 1px solid #eeeeee; border-bottom: 1px solid #eeeeee; border-right: 1px solid #eeeeee;">125</td>
                                    <td style="width: 50px; border-bottom: none; border-top: none;"></td>
                                    <td style="width: 30px; border-left: 1px solid #eeeeee; border-bottom: 1px solid #eeeeee;">21</td>
                                    <td style="width: 80px; border-left: 1px solid #eeeeee; border-bottom: 1px solid #eeeeee;">469321</td>
                                    <td style="width: 150px; border-left: 1px solid #eeeeee; border-bottom: 1px solid #eeeeee;">Sakna Hewa</td>
                                    <td style="width: 100px; border-left: 1px solid #eeeeee; border-bottom: 1px solid #eeeeee;">sakhewa</td>
                                    <td style="width: 40px; border-left: 1px solid #eeeeee; border-bottom: 1px solid #eeeeee; border-right: 1px solid #eeeeee;">125</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
name: "assignment-results"
}
</script>

<style scoped>

</style>
