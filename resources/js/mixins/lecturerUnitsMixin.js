import config from "../../../config";
import axios from "axios";

export default {
    data() {
        return {
            units: []
        }
    },
    mounted() {
        this.getLecturerUnits()
    },
    methods: {
        getLecturerUnits() {
            let endpoint = config.BASE_URL + "api/lecturer/units"

            axios.get(endpoint, {
                headers: {
                    'token': localStorage.token
                }
            }).then((response) => {
                this.units = response.data.units
                console.log(this.units)
            })
        }
    }
}