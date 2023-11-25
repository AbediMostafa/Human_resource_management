import ApiLayer from "@/core/services/ApiLayer";


class CommonApi {

    /**
     * Default route for all common apis
     */
    public static route = 'auth-less-common';

    public static getGrades() {
        return ApiLayer.postApi(CommonApi.route, 'getGrades');
    }

    public static getJobs() {
        return ApiLayer.postApi(CommonApi.route, 'getJobs');
    }
}

export default CommonApi;

