<template>
    <div>
        <nav-bar
            v-bind:redirectLoc="'/lecturer/'">

        </nav-bar>
        <div class="container">
            <div class="row" style="margin-top: 90px;padding: 5px;">
                <div class="col">
                    <a href="/lecturer/" style="color: #274F73">LECTURER HOME / </a>
                    <a href="/lecturer/requests" style="color: #274F73">REQUESTS / </a>
                    <a href="#" style="color: #ff7350">Student's name</a>
                </div>
            </div>

            <div class="form-row justify-content-center" style="margin-left: 10px; padding-top: 20px;">
                <form class="form-inline mr-auto" target="_self">
                    <div class="form-group">
                        <label>Search: &nbsp</label>
                        <label for="search-field"><i class="fa fa-search" style="color: rgb(53, 53, 53);"></i></label>
                        <input class="form-control search-field" type="search" id="search-field" name="search">
                    </div>
                </form>
            </div>

            <!--============ Content ===========-->
            <div class="content">
                <div class="row">
                    <label>Reference number: <b>012345</b></label>
                </div>
                <div class="row">
                    <label>Name: <b>Sakna Hewa</b></label>
                    <span style="width: 20px;"></span>
                    <label>Subject: Re-mark the assignment 2</label>
                </div>
                <hr>
                <div class="row">
                    <p>Hi Mira,</p>
                    <p>How are you?</p>
                    <p>I am writing to you about the result of assignment 2 that I am not satisfied with the final mark released.</p>
                    <p>I think there were other valuable points in my assignment that you could  miss them. I believe that these points are good enough for me to get more marks.</p>
                    <p>Please, can you double check my assignment and consider re-mark it?</p>
                    <p>Thank you have a good weekdend!</p>
                    <p>I am looking forwards to hearing from you.</p>
                    <p>Best regards,</p>
                    <p>Sakna</p>
                </div>
                <!--Reply message-->
                <div>
                    <div id="repMes" style="margin-bottom: 10px; margin-top: 10px;">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col" width="80%" style="text-align: left;">Message replied</th>
                                <th scope="col" width="20%" style="text-align: center;">Date</th>
                            </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row border-top pt-3 repSection" id="repSection">

                    <textarea id="rep" class="rep" placeholder="Enter your response here..."></textarea>
                    <button type="button" class="btn-pas" onclick="sendMes()">Send</button>
                    <button type="button" class="btn-pas" onclick="hideMes()">Discard</button>
                </div>
                <!--End Reply message-->

                <div class="row">
                    <button type="button" class="btn-pas" onclick="displayMesSection()">Reply</button>
                </div>
            </div>
            <!--============= End Content ==========-->
        </div>
    </div>

</template>

<script>
export default {
    name: "request-details"
}
</script>

<style scoped>

</style>
