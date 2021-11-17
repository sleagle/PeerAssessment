export default {
    data() {
        return {
            unitCode: ''
        }
    },
    mounted() {
        this.getRouteDetails()
    },
    methods: {
        getRouteDetails() {
            let url = window.location.href;
            this.unitCode = url.split('=')[1];
        }
    }
}