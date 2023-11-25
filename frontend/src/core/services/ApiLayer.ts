import ApiService from "@/core/services/ApiService";
import store from "@/store";
import axios from "axios";

class ApiLayer {

    /**
     * Axios post method
     *
     * @param resource destination url
     * @param method backend controller handler method
     * @param data data to be transferred
     * @param callB call back function
     */
    public static post(resource, method, data, callB) {

        return ApiService
            .post(resource, {method, ...data})
            .then(response => callB(response));
    }

    /**
     * Promised base post api call
     *
     * @param resource
     * @param method
     * @param data
     */
    public static postApi(resource, method, data = {}) {
        return ApiService
            .post(resource, {method, ...data});
    }
}

export default ApiLayer;