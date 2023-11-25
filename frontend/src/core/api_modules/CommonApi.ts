import ApiLayer from "@/core/services/ApiLayer";


class CommonApi {

    /**
     * Default route for all common apis
     */
    public static route = 'common';

    public static createApplicantApis() {
        return ApiLayer.postApi(CommonApi.route, 'createApplicantApis');
    }

    public static applicantAdvanceSearchApi() {
        return ApiLayer.postApi(CommonApi.route, 'applicantAdvanceSearchApi');
    }

    public static getStatesOfCountry(data) {
        return ApiLayer.postApi(CommonApi.route, 'getStatesOfCountry', data);
    }

    public static getCitiesOfState(data) {
        return ApiLayer.postApi(CommonApi.route, 'getCitiesOfState', data);
    }

    public static getRoles() {
        return ApiLayer.postApi(CommonApi.route, 'getRoles');
    }

    public static getUsers() {
        return ApiLayer.postApi(CommonApi.route, 'getUsers');
    }

    public static getPermissions() {
        return ApiLayer.postApi(CommonApi.route, 'getPermissions');
    }

    public static getOriginalities() {
        return ApiLayer.postApi(CommonApi.route, 'getOriginalities');
    }

    public static getDegrees() {
        return ApiLayer.postApi(CommonApi.route, 'getDegrees');
    }

    public static getJobs() {
        return ApiLayer.postApi(CommonApi.route, 'getJobs');
    }
}

export default CommonApi;

