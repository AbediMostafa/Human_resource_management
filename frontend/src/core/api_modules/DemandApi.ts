import ApiLayer from "@/core/services/ApiLayer";

class DemandApi {

    /**
     * Default route for all demand apis
     */
    public static route = 'demand';

    public static create(data) {
        return ApiLayer.postApi(DemandApi.route, 'create', data);
    }

    public static index(data) {
        return ApiLayer.postApi(DemandApi.route, 'index', data);
    }
}

export default DemandApi;