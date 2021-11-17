export default {
    data() {
        return {
            assignmentId: 0,
            currentBreadcrumb: '',
            currentView: '',
        }
    },
    mounted() {
        this.setupInformation()
        this.getBreadCumEndDesc()
    },
    methods: {
        setupInformation() {
            let url = window.location.href;
            this.assignmentId = url.split('/')[6];
            this.currentView = url.split('/')[7];
        },
        getBreadCumEndDesc() {
            switch (this.currentView) {
                case "info":
                    this.currentBreadcrumb = "BASIC DESCRIPTION";
                    break;

                case "topics-spec":
                    this.currentBreadcrumb = "TOPIC SPECIFICATION";
                    break

                case "topics-allocation":
                    this.currentBreadcrumb = "TOPIC ALLOCATION";
                    break

                case "marking-criteria":
                    this.currentBreadcrumb = "MARKING CRITERIA";
                    break

                case "peer-allocation":
                    this.currentBreadcrumb = "PEER ALLOCATION";
                    break

                case "deadlines":
                    this.currentBreadcrumb = "DEADLINES";
                    break

                case "progress":
                    this.currentBreadcrumb = "ASSIGNMENT PROGRESS";
                    break

                case "marking-summary":
                    this.currentBreadcrumb = "MARKING SUMMARY";
                    break

                case "marking-details":
                    this.currentBreadcrumb = "MARKING DETAILS";
                    break

                case "results":
                    this.currentBreadcrumb = "ASSIGNMENT RESULTS";
                    break
            }
        }
    }
}