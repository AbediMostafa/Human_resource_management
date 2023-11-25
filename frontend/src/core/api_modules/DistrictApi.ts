import ApiLayer from "@/core/services/ApiLayer";

class DistrictApi {

    /**
     * Default route for all district apis
     */
    public static route = 'district';

    /**
     * District index call
     */
    public static index() {
        return ApiLayer.postApi(DistrictApi.route, 'index')
    }
}

export default DistrictApi;