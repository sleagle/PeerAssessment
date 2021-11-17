<template>
    <div>
        <nav-bar
            v-bind:redirectLoc="'/student/'">

        </nav-bar>
        <section id="main" style="height: 100%;">
            <view-assignment-sidebar v-bind:assignment-id="assignmentId" v-bind:current-view="currentView">

            </view-assignment-sidebar>

        <!--=========== Main class ===============-->
            <div class="main">
                <div class="row d-flex pl-4 pt-3 direction" style="margin-top: 80px; margin-bottom: 20px; margin-left: 22px;">
                    <a style="color: #274F73;" href="student-home.html">HOME /</a>
                    <a style="color: #274F73;" href="student-assignments-list.html">&nbsp Unit code selected /</a>
                    <a style="color: #ff7350;" href="feedback-marking.html">&nbsp FEEDBACK MARKING</a>
                </div>
                <!--======== Section of student work ===========-->

                <div class="section">
                    <div class="container box fadeIn animated" style="width: 95%;">
                        <br>
                        <h4 style="font-family: 'Noto Serif', serif; color: #274F73;">Feedback Marking</h4>
                        <lable><strong style="color: blue;">Unit code - Assignment Title</strong></lable>
                        <br><br>

                        <!-- Assignment Marking Criteria-->
                        <h5 style="color: #274F73;"><strong>Feedback marking criteria </strong></h5>
                        <ul>
                            <li>CRA1: Feedback</li>

                        </ul>

                        <!--Table of assignments -->
                        <div>
                            <table class="table table-bordered">
                                <thead>
                                <tr class="text-center">
                                    <td>#</td>
                                    <td>Peer Comments</td>
                                    <td>Expected Mark</td>
                                    <td>CRA1</td>
                                    <td>Total</td>
                                    <td>Feedback Comments</td>
                                    <td>Done</td>
                                </tr>
                                </thead>
                                <tbody>
                                <tr class="text-center">
                                    <td>1</td>
                                    <td><a class="dropdown-item" href="" data-toggle="modal" data-target="#viewPeerComments">View</a></td>
                                    <td>
                                        <select>
                                            <option>HD</option>
                                            <option>DN</option>
                                            <option>CR</option>
                                            <option>PP</option>
                                            <option>NN</option>
                                        </select>
                                    </td>
                                    <td>0</td>
                                    <td>0</td>
                                    <td>
                                        <a class="dropdown-item" href="feedback-marking-to-peers.html">Feedback</a>
                                    </td>
                                    <td>
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input">
                                        </div>
                                    </td>
                                </tr>

                                <tr class="text-center">
                                    <td>2</td>
                                    <td><a class="dropdown-item" href="" data-toggle="modal" data-target="#viewPeerComments">View</a></td>
                                    <td>
                                        <select>
                                            <option>HD</option>
                                            <option>DN</option>
                                            <option>CR</option>
                                            <option>PP</option>
                                            <option>NN</option>
                                        </select>
                                    </td>
                                    <td>0</td>
                                    <td>0</td>
                                    <td>
                                        <a class="dropdown-item" href="feedback-marking-to-peers.html">Feedback</a>
                                    </td>
                                    <td>
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input">
                                        </div>
                                    </td>
                                </tr>

                                <tr class="text-center">
                                    <td>3</td>
                                    <td><a class="dropdown-item" href="" data-toggle="modal" data-target="#viewPeerComments">View</a></td>
                                    <td>
                                        <select>
                                            <option>HD</option>
                                            <option>DN</option>
                                            <option>CR</option>
                                            <option>PP</option>
                                            <option>NN</option>
                                        </select>
                                    </td>
                                    <td>0</td>
                                    <td>0</td>
                                    <td>
                                        <a class="dropdown-item" href="feedback-marking-to-peers.html">Feedback</a>
                                    </td>
                                    <td>
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input">
                                        </div>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>

                        <!-- End Table of assignments -->
                        <br><br>

                    </div>
                    <!--======== End Section of student work===========-->

                    <!--======== The Modal =======-->
                    <div class="modal" id="viewPeerComments">
                        <div class="modal-dialog modal-lg modal-dialog-scrollable">
                            <div class="modal-content">

                                <!-- Modal Header -->
                                <div class="modal-header">
                                    <h3 class="modal-title">Comments from the student who marked your work.</h3>
                                    <button type="button" class="close" data-dismiss="modal">×</button>
                                </div>

                                <!-- Modal body -->
                                <div class="modal-body">
                                    <label><b>CRA1: Correct</b></label>
                                    <p>There are some things you did very well about the correct requirement of the paper. You have done a lot of
                                        good things that I have ever never thought I will meet one day. However, you need to do something like this, like that...
                                    </p>
                                    <label><b>CRA2: Comprehensive</b></label>
                                    <p>There are some things you did very well about the comprehensive criteria. You have done a lot of
                                        good things that I have ever never thought I will meet one day. However, you need to do something like this, like that...
                                    </p>
                                    <label><b>CRA3: Presentation</b></label>
                                    <p>You have a good presentation. You have done a lot of
                                        good things that I have ever never thought I will meet one day. However, you need to do something like this, like that...
                                    </p>
                                    <label><b>CRA4: Editing</b></label>
                                    <p>The paper was done very well in editing. You have done a lot of
                                        good things that I have ever never thought I will meet one day. However, you need to do something like this, like that...
                                    </p>
                                    <label><b>CRA5: Length</b></label>
                                    <p>Your work has a good length as required. You have done a lot of
                                        good things that I have ever never thought I will meet one day. However, you need to do something like this, like that...
                                    </p>

                                </div>

                                <!-- Modal footer -->
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                </div>

                            </div>
                        </div>
                    </div>

                    <!--======= End The Modal =======-->

                </div>
                <!--=========== End Main class ===============-->
            </div>
        </section>
        <!--========End Section===========-->
    </div>
</template>

<script>
export default {
name: "assignment-feedback-marking"
}
</script>

<style scoped>

</style>
