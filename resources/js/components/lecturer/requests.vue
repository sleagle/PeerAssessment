<template>
    <div>
        <nav-bar
            v-bind:redirectLoc="'/lecturer/'">

        </nav-bar>
        <div class="container box mx-auto" style="width: 90%; margin-top: 100px; height: auto;">
            <div class="row" style="padding: 5px;">
                <div class="col">
                    <a href="/lecturer/" style="color: #274F73">LECTURER HOME / </a>
                    <a href="#" style="color: #ff7350">REQUESTS</a>
                </div>
            </div>

            <div class="form-row justify-content-center" style="margin-left: 5px; padding-top: 20px;">
                <form class="form-inline mr-auto" target="_self">
                    <div class="form-group">
                        <label>Search: &nbsp</label>
                        <label for="search-field"><i class="fa fa-search" style="color: rgb(53, 53, 53);"></i></label>
                        <input class="form-control search-field" type="search" id="search-field" name="search">
                    </div>
                </form>
            </div>

            <!--============ Table ===========-->
            <div style="overflow:auto; height:600px;">
                <div style="overflow:auto; height:500px; margin-top: 10px;" id="table-mark">
                    <table class="table fadeIn animated" style="font-size:90%; table-layout:fixed; width:100%; border-top: none;" cellspacing="0">
                        <tbody>
                        <tr class="request-new zoom">
                            <td style="width: 100px;">Sakna Hewa</td>
                            <td style="width: 150px;"><a href="/lecturer/request-details">Request for re-mark my assignment 2</a></td>
                            <td style="width: 200px;">Dear Mira, I am writing to you about ...</td>
                            <td style="width: 100px;">20 Jun</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <!--============= End table ==========-->
        </div>
    </div>

</template>

<script>
export default {
    name: "requests"
}
</script>

<style scoped>

</style>
